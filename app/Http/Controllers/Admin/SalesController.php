<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Sale;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Items;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
use App\Models\Setting;
use App\Http\Controllers\SalesCalculationsTrait;
use \stdClass;
use App\Models\Tax;
use App\Models\StockIssuing;
use App\Http\Controllers\StockProductTrait;
use App\Models\Stock;
use App\Models\InStock;
use App\Models\Outstock;
use  App\Models\StockModes;


class SalesController extends Controller
{
    use SalesCalculationsTrait;
    use StockProductTrait;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mode)
    {

        // $salesIssuing = 

        $sales = Sale::where('cash_mode', $mode)->get();
        return view('manager.sales.index')
        ->with('sales', $sales)
        ->with('mode', $mode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.sales.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $customer_id = $request->customer_id;
        $validity = $request->validity;
        $due_date = $request->due_date;
        $stock_id = $request->stock_id;
        // save customer id in sales table
        $items = $request->items;

        // making sure that the selected customer is plesent
        $customer = Customer::find($customer_id);
        if( !$customer ){
            return response()->json(['error' => 'customer not found... ']);
        }

        $vat = Tax::where('type', 1)->first();
        // create sale object for current  session
        $sale = Sale::create([
            'customer_id' => $customer_id,
            'validity' => $validity,
            'due_date' => $due_date,
            'cash_mode' => 2,
            'vat' => $vat->rate ?? 0,
            'pi_number' => time(),
            'stock_id' => $stock_id,
        ]);

        // checking if the sale object is created and return error if not
        if( !$sale ){
            return response()->json(['error' => 'sale not found...']);
        }

        // finally loop throgh every item and attach to the current sale
        foreach( $items as $item ){
                $sale->items()->attach($item['item_id'], [
                    'quantity' => $item['item_quantity'],
                    'due_price' => $item['due_price'],
                ]);
        }

        return $sale->id;
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $sale = Sale::find($id);
        foreach( $sale->items as $item ){
            $sale->items()->detach($item->id);
        }
        $sale->delete();

        return 1;
    }



    /**
     * 
     */
    function proforma($id){
        $sale = Sale::where('cash_mode', 2)->where('id', $id)->first();
        if(!$sale){
            return redirect('/sales/2');
        }
       
        $items = $sale->items()->where('invoice_mode', 0)->get();

        $confirmed = $sale->items()->where('invoice_mode', 1)->get();

        $customer = $sale->customer;

        $vat_rate = $sale->vat ?? 0;

        $settings = Setting::all();
        $data = [];
        foreach($settings as $item){
            $data[$item->key] = $item->value;
        }
    
        // define Object to carry my datas;
        $purchase = new stdClass();
        // Assign data to my object
        $purchase->subtotal = $this->calculateSubTotal($sale->items);
        $purchase->current = $this;
        $purchase->discounted = $this->discounted($sale, $vat_rate);
        $purchase->vat_total = $this->vatTotal($sale->items, $vat_rate);

        // after creating invoice
        $purchase->subtotalAfter = $this->calculateSubTotalAfter($sale->items );

        return view('manager.sales.proforma', [
            'items' => $items,
            'confirmed' => $confirmed,
            'sale' => $sale,
            'customer' => $customer, 
            'purchase' => $purchase,
            'setting' => $data, 
            'vat_rate' => $vat_rate,
        ]);
    }


    /**
     * 
     */
    public function make_invoice(Request $request, $id){
        // select the sale for modification
        $sale = Sale::find($id);
        // the items that user select for confirmation
        $checked = $request->item_id;

        if($checked){
            foreach($checked as $item){
                $item = $sale->items()->where('item_id', $item)->first();
                if( $item ){
                    $item->pivot->invoice_mode = 1;
                    $item->pivot->save();
                }
            }
        }
        return redirect()->back();
    }


    /**
     * 
     */
    public function undo($id){
        $sale = Sale::find($id);
        if(!$sale){
            return redirect()->back()->with('error', 'No record found!');
        }
        $sale->items()->update([
            'invoice_mode' => 0
        ]);
        return redirect()->back();
    }

    function set_discount(Request $request, $id){
        $sale = Sale::find ($id);
        if(!$sale){
            return redirect()->back()->with('error', 'Record not found!');
        }
        
        $sale->discount = $request->discount;
        $sale->save();
        return redirect()->back();
    }



    /**
     * 
     */
    function confirm_invoice(Request $request, $id){

        $sale = Sale::find($id);
        if(!$sale){
            return redirect()->back()->with('error', 'Record not found!');
        }
        $checked = $sale->items()->where('invoice_mode', 1)->count();
        if($checked == 0){
            return redirect()->back();
        }
        $sale->invoice_number = time();
        $sale->save();

        if( $sale->items()->count() < 1){
            return redirect()->back()->with('error', 'must have at leat one item in list...');
        }

        foreach( $sale->items()->where('invoice_mode', 1)->get() as $item ){

            $item_sale = DB::table('item_sale')
                ->where('item_id', $item->id)
                ->where('sale_id', $sale->id)
                ->first();
        }


        $removable = $sale->items()->where('invoice_mode', 0)->get();
        if($removable->count() == 0){
            return redirect('/sales/2');
        }
        foreach($removable as $item){
            $sale->items()->detach($item->id);
        }
        return redirect('/sales/2');
    }



    /**
     * 
     */
    public function set_cash(Request $request, $id){

        $request->validate([
            'cash_mode' => 'required',
            'method' => 'exclude_if:cash_mode,0|required',
        ]);

        $sale = Sale::find($id);
        if(!$sale){
            return redirect()->back()->with('error', 'Record not found!');
        }
        
        $saleObj['cash_mode'] = $request->cash_mode;
        
        if( $request->cash_mode == '1' ){
            $saleObj['payment_method_id'] = $request->method; 
        }
        
        $sale->update( $saleObj );

        return redirect('/sales'.'/'.$request->cash_mode);
    }




    public function printInvoice(Request $request, $id){

        // $upTo = Carbon::createFromFormat('Y-m-d', $request->upTo)->format('Y-m-d');
        // $from = $request->from;
        // $visits = visit::whereDate('created_at', '>=', $request->from, 'and')
        // ->where('visit_type', 'normal')
        // ->where('paid', true)
        // ->whereDate('created_at', '<=', $upTo)
        // ->orderBy('created_at', 'desc')->get();

        $sale = Sale::where('id', $id)->first();

        // $pdf = PDF::loadView('admin.pdfs.sales_invoice', ['sale' => $sale ]);

        // // ->setPaper(array(0, 0, 296, 412), 'landscape')

        // $pdf->output();
        // $dom_pdf = $pdf->getDomPDF();

        // $canvas = $dom_pdf ->get_canvas();
        // $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));

        // return  $pdf->stream('sales_invoice.pdf');

    }



    /**
     * preview function
     */
    public function preview($id){
        $sale = Sale::find($id);
        $customer = $sale->customer;
        $vat_rate = $sale->vat ?? 0;
        $setting = Setting::all();
        $settings = Setting::all();
        $data = [];
        foreach($settings as $item){
            $data[$item->key] = $item->value;
        }
        $setting = $data;
        $purchase = new stdClass();
        // Assign data to my object
        $purchase->subtotal = $this->calculateSubTotal($sale->items);
        $purchase->current = $this;
        $purchase->discounted = $this->discounted($sale, $vat_rate);
        $purchase->vat_total = $this->vatTotal($sale->items, $vat_rate);
        return view('manager.sales.preview', compact('sale', 'customer', 'purchase', 'vat_rate', 'setting'));
    }





    /**
     * confirm sales function
     */
    public function confirm_sales($id) {
        $sale = Sale::find($id);
        if( !$sale ){
            return redirect()->back()->with('error', 'sale object wasn\'t found');
        }
        if($sale->stock_issuings->count() > 0){
            return redirect()->back()->with('error', 'Aready Confirmed...');
        }
        return view("manager.sales.confirm", compact('sale'));
    }





    /**
     * createing the stock issuing object for a sale
     */
    public function updateIssuing(Request $request, $id){

        $rules = [
            'selectedPacks' => 'required|array',
            'selectedPacks.*.qty' => 'required|min:1',
            'cash_mode' => 'required',
            'sale_id' => 'required',
            'payment_method' => 'required_if:cash_mode,1',

        ];

        $saleObject = Sale::find( $request->sale_id );

        if( !$saleObject ){
            return response()->json(['error', 'This sale is not found...']);
        }


        if( $saleObject->StockIssuing ){
            return response()->json(['error', 'exists']);
        }

        $validate = Validator::make($request->all(), $rules, $messages = [
            'cash_mode.required' => 'Receive Payment field is requeired',
            'payment_method.required' => 'payment method field is required',
            'selectedPacks.required' => 'You didn\'t choose any items', 
        ]);

        if( $validate->fails() ){
            $data = [
                'validation',
                $validate->errors()->all(),
            ];
            return response()->json($data);
        }


        $selectedPacks = $request->selectedPacks;

        // counting the quantities of the products presented
        $result = array();
    
        foreach( $selectedPacks as $selected ){
            $itemsList[$selected['id']][] = $selected;
        }


        $allItemSale = DB::table('item_sale')
        ->where('sale_id', $saleObject->id )->get();


        if( $allItemSale->count() != sizeof($itemsList) ){
            return response()->json(['error', 'please fill all the fields...']);
        }

        foreach( $itemsList as $key=>$items ){

            $keyItem = Item::find($key);

            $itemSale = DB::table('item_sale')->where('item_id', $keyItem->id)
            ->where('sale_id', $saleObject->id )->first();

            $counter = 0;

            foreach( $items as $item ){    
                $inStock = InStock::where('id', $item['inStockId'])->first();

            /**
             * in every iteration check if the quantity of item
             * specified in that iteration exceed the sum quantity
             * of that product  in selling queue (invoice)
             */
            if( $item['qty'] > $itemSale->quantity ){
                return response()->json(['error', 'You pick too many '.$keyItem->code.' than required - WITH Description  '. $keyItem->desc]);
            }elseif( $counter < $itemSale->quantity ){
                return response()->json(['error', 'You pick less '.$keyItem->code.' than required - WITH Description  '. $keyItem->desc]);
            }

                if(self::currentQuantity($inStock) < $item['qty']){
                        return response()->json(['error', 'Not Enough Quantity of '.$keyItem->code.' In '.Carbon::parse($item['date'])->format('d-M Y'). ' Entrence  - WITH Description  '. $keyItem->desc]);
                    }
                $counter += $item['qty'];
            }

            /**
             * checking if the summation of the item in the iteration
             * exceed that in the selling queue (invoice)
             */
            if( $counter > $itemSale->quantity ){
                return response()->json(['error', 'You pick too many '.$keyItem->code.' than required - WITH Description  '. $keyItem->desc]);
            }elseif( $counter < $itemSale->quantity ){
                return response()->json(['error', 'You pick less '.$keyItem->code.' than required - WITH Description  '. $keyItem->desc]);
            }


        }

        $stock = Stock::where('id', $id)->first();
        if( !$stock ){
            return response()->json(['error', 'stock is absent']);
        }

        $sold = StockModes::where('name', 'sold')->first();

        foreach( $selectedPacks as $selected ){    
            StockIssuing::create([  
            'sale_id' => $request->sale_id,
            'item_id' => $selected['id'],
            'quantity' => $selected['qty'],
            'in_stock_id' => $selected['inStockId'],
            ]);

            OutStock::create([
                'in_stock_id' => $selected['inStockId'],
                'quantity' => $selected['qty'],
                'date_out'=> \Carbon\Carbon::now(),
                'stock_mode_id' => $sold->id,
            ]);

            $saleObject->update([
                'cash_mode' => $request->cash_mode,
                'payment_method_id' => $request->payment_method,
            ]);         
        }
        return response()->json(['success', 'successfully inserted']);;
    }


    public static function saleObject($id){
        $sale = Sale::where('id', $id)->first();
        return $sale;
    }

}
