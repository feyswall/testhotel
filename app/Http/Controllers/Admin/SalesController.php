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
                ->where('sale_id', $sale->stock_id)
                ->first();
    
            // createing the stock issuing
            StockIssuing::create([
                'sale_id' => $sale->id,
                'item_sale_id' => $item_sale->id,
                'quantity' => $item->pivot->quantity,
            ]);
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

    function preview($id){
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

    public function confirm_sales($id) {
        $sale = Sale::find($id);
        return view("manager.sales.confirm", compact('sale'));
    }



}
