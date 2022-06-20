<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $expenses = Expense::where('payee', '!=', null)->limit(30)->orderBy('id', 'desc')->get();
        return view('admin.expenses.index', compact('expenses'));
    }

    function create(){
        $expense_cat = Category::where('type', 2)->get(); 
        $pay_methods = PaymentMethod::all();
        return view('admin.expenses.create', compact('expense_cat', 'pay_methods'));
    }

    function store(Request $request){
        $inputs = $request->all();
        $insert = Expense::create($inputs);

        if($insert){
            return redirect('/expenses');
        }
    }

    


}
