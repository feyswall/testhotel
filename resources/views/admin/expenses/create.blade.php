@extends('pageLayouts.admin')

@section('title')
    <title>Expenses</title>
@endsection

@section('content')
   
    <main class="content p-4">
        <div class="container-fluid p-0">

            @include('admin._partials._success_and_errors')

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Expenses</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    @include('admin._partials._success_and_errors')
                    <div class="card">
                        <div class="card-body">
                            <form action="/add_expenses" method="POST">
                                @csrf 
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="payee">Payee</label>
                                        <input name="payee" type="text" class="form-control" id="payee" placeholder="Payee Name" required>
                                        @error('payee')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="payee_account">Payee Account (Optional)</label>
                                        <input name="payee_account" value="" type="text" class="form-control" id="payee_account" placeholder="Payee Account ">
                                         @error('payee_account')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="cat">Category</label>
                                        <select name="category_id" id="cat" class="form-control" required>
                                            <option value="">Choose Category</option>
                                            @foreach ($expense_cat as $cat)
                                              <option value="{{$cat->id}}">{{$cat->name}}</option>  
                                            @endforeach
                                        </select>
                                     @error('category_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="amount">Amount</label>
                                        <input name="amount" value="" type="number" min="0" class="form-control" id="amount" placeholder="Expense Amount" required>
                                         @error('amount')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="date">Payment Date</label>
                                        <input name="pay_date" type="date" value="{{date('Y-m-d')}}" class="form-control" id="date" placeholder="Date" required>
                                         @error('pay_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="cat">Payment Method</label>
                                        <select name="payment_method_id" id="cat" class="form-control" required>
                                            <option selected>Choose Method</option>
                                            @foreach ($pay_methods as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                         @error('payment_method_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="service">Item / Service</label>
                                        <input name="item" type="text"  class="form-control" id="service" placeholder="Item / Service" required>
                                         @error('item')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="desc">Description</label>
                                        <textarea value="{{ old('desc') }}" rows="3" type="text" name="desc" class="form-control"
                                            id="desc" required>{{  old('desc')}}</textarea>
                                        @error('desc')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save Expenses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
