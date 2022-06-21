@extends('pageLayouts.admin')

@section('title')
    <title>Expenses | Edit</title>
@endsection

@section('content')
     <main class="content p-4">
        <div class="container-fluid p-0">
            <a href="/expenses" class="btn btn-primary float-end mt-n1">View Expenses</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Edit Expense Record</h1>
            </div>

            <div class="card">
                <div class="card-body">
                            <form method="POST" action="{{ route('expense-save', $expense->id) }}">
                            @csrf
                            @method('put')           
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="payee">Payee</label>
                                    <input name="payee" value="{{$expense->payee}}" type="text" class="form-control" id="payee" placeholder="Payee Name" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="payee_account">Payee Account (Optional)</label>
                                    <input name="payee_account" value="{{$expense->payee_account}}" type="number" min="0" class="form-control" id="payee_account" placeholder="Payee Account ">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="cat">Category</label>
                                    <select name="category_id" id="cat" class="form-control" required>
                                        <option value="{{$expense->category->id}}">{{$expense->category->name}}</option>
                                        @foreach ($expense_cat as $cat)
                                          <option value="{{$cat->id}}">{{$cat->name}}</option>  
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="amount">Amount</label>
                                    <input name="amount" value="{{$expense->amount}}" type="number" min="0" class="form-control" id="amount" placeholder="Expense Amount" required>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="date">Payment Date</label>
                                    <input name="pay_date" type="text" value="{{$expense->pay_date}}" class="form-control" id="date" placeholder="Date" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="cat">Payment Method</label>
                                    <select name="payment_method_id" id="cat" class="form-control" required>
                                        <option value="{{$expense->paymentMethod->id}}">{{$expense->paymentMethod->name}}</option>
                                        @foreach ($pay_methods as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="service">Product / Service</label>
                                    <input name="item" type="text" value="{{$expense->item}}" class="form-control" id="service" placeholder="Product / Service" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="desc">Description</label>
                                    <textarea rows="3" type="text" name="desc" class="form-control"
                                        id="desc" required>{{ $expense->desc }}</textarea>
                                    @error('desc')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        <button type="reset" class="btn btn-secondary">Reset Form</button>
                        <button type="submit" class="btn btn-success">Save Item</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
