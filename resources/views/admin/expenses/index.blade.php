@extends('pageLayouts.admin')

@section('title')
    <title>Records | Expenses</title>
@endsection

@section('content')
    <main class="content p-4">
        <div class="container-fluid p-0">
            <a href="/create_expenses" class="btn btn-primary float-end mt-n1">New Record</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Expenses Records</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-buttons" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Payee</th>
                                        <th>Amount</th>
                                        <th>Category</th>
                                        <th>Product/Service</th>
                                        <th>Payment Method</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach ($expenses as $expense)
                                 <tr>
                                    <td>{{$expense->payee}}</td>
                                    <td>{{$expense->amount}}</td>
                                    <td>{{$expense->category->name}}</td>
                                    <td>{{$expense->item}}</td>
                                    <td>{{$expense->paymentMethod->name}}</td>
                                    <td>
                                        <a href="{{ route('expenses-edit', $expense->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    </td>
                                </tr>
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
