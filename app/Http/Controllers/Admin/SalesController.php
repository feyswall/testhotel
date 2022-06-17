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

class SalesController extends Controller
{
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
        // save customer id in sales table
        $items = $request->items;

        // making sure that the selected customer is plesent
        $customer = Customer::find($customer_id);
        if( !$customer ){
            return response()->json(['error' => 'customer not found... ']);
        }

        // create sale object for current  session
        $sale = Sale::create([
            'customer_id' => $customer_id,
            'validity' => $validity,
            'due_date' => $due_date,
            'cash_mode' => 2,
            'pi_number' => time(),
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
                    'due_tax' => $item['due_tax'],
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

    function proforma($id){
        $sale = Sale::where('cash_mode', 2)->where('id', $id)->first();
        if(!$sale){
            return redirect('/sales/2');
        }
        $items = $sale->items()->where('invoice_mode', 0)->get();
        $confirmed = $sale->items()->where('invoice_mode', 1)->get();
        $customer = $sale->customer;

        $settings = Setting::all();
        $data = [];
        foreach($settings as $item){
            $data[$item->key] = $item->value;
        }

        return view('manager.sales.proforma')->with([
            'items' => $items,
            'confirmed' => $confirmed,
            'sale' => $sale,
            'customer' => $customer, 
            'setting' => $data
        ]);
    }

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
        $removable = $sale->items()->where('invoice_mode', 0)->get();
        if($removable->count() == 0){
            return redirect('/sales/2');
        }
        foreach($removable as $item){
            $sale->items()->detach($item->id);
        }
        return redirect('/sales/2');
    }

    public function set_cash(Request $request, $id){
        $sale = Sale::find($id);
        if(!$sale){
            return redirect()->back()->with('error', 'Record not found!');
        }
        $sale->cash_mode = $request->cash_mode;
        $sale->save();
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



}
