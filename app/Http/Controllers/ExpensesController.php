<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contract;
use App\Models\Expense;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index(Request $request){
        $category_id = null;
        $categories = Category::where('type', 2)->get();
        if(isset($request->category)){
            $category_id = $request->category;
            $expenses = Expense::where('payee', '!=', null)
            ->where('category_id', $category_id)
            ->limit(30)->orderBy('id', 'desc')->get();
        }else{
            $expenses = Expense::where('payee', '!=', null)->limit(30)->orderBy('id', 'desc')->get();
        }

        return view('admin.expenses.index', compact('expenses', 'categories', 'category_id'));
    }

    function create(){
        $expense_cat = Category::where('type', 2)->get(); 
        $pay_methods = PaymentMethod::all();
        return view('admin.expenses.create', compact('expense_cat', 'pay_methods'));
    }

    function store(Request $request){

        $rules = [
            'payee' => 'required',
            'payee_account' => 'sometimes',
            'category_id' => 'required',
            'amount' => 'required',
            'pay_date' => 'required',
            'payment_method_id' => 'required',
            'item' => 'required',
            'desc' => 'sometimes'
        ];

        $validate = Validator::make( $request->all(), $rules )->validate();

        $inputs = $request->all();
        $insert = Expense::create($inputs);

        if( !$insert ) {
            return redirect()->back()->with('error', 'fail to store expenses record..');
        }
            return redirect('/expenses');
    }

    
    public function update($id){
        $expense  = Expense::find($id);
        $expense_cat = Category::where('type', 2)->get(); 
        $pay_methods = PaymentMethod::all();
        return view('admin.expenses.edit', compact('expense', 'expense_cat', 'pay_methods'));
    }


    public function save(Request $request, $id){
        $data = Expense::find($id);

        $inputs = $request->all();
        $update = $data->update($inputs);

        if($update){
            return redirect('/expenses');
        }
    }

    public function delete($id){
        $delete = Expense::destroy($id);

        if ($delete) {
             return redirect('/expenses');
        }
    }

}
