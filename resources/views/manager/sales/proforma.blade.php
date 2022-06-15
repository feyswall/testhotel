@extends('pageLayouts.admin')

@section('title')
    <title>Records | Proforma</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Prepare Invoice</h1>
            </div>

           <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Customer Details</h5>
                        </div>
                        <div class="card-body mt-n4">
                            <table class="table table-sm mb-2 table-bordered">
                                <tbody>
                                    <thead>
                                        <th>Names</th>
                                        <th>Address</th>
                                        <th>Company</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>ZRB</th>
                                    </thead>
                                    <tr>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->address}}</td>
                                        <td>{{$customer->company}}</td>
                                        <td>{{$customer->phone}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->zrb}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
           </div>

            <div class="row">
                <div class="col-12 col-lg-6 col-xxl-6 d-flex">
                    <div class="card flex-fill">
                    <form action="/sales/make_invoice/{{$sale->id}}" method="post">
                        @csrf 
                        @method('PUT')
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <button class="btn btn-success" type="submit"><i class="la la-sync"></i> Convert to Invoice</button>
                            </div>
                            <div class="card-actions float-end mb-3">
                                <button class="btn btn-info mx-2" type="submit"><i class="la la-undo"></i> Undo</button>
                            </div>
                            <h5 class="card-title mb-0">Proforma</h5>
                        </div>
                        <hr>
              
                        <table class="table table-borderless my-0">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Item code</th>
                                    <th>Item name</th>
                                    <th>Price</th>
                                    <th>Tax</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->pivot->due_price}}</td>
                                        <td>{{$item->pivot->due_tax}}</td>
                                        <td class="text-center">{{$item->pivot->quantity}}</td>
                                        <td><input type="checkbox" name="item_id[]" value="{{$item->id}}" checked="yes"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xxl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header border-bottom">
                            <div class="card-actions float-end row">
                                <div class="col col-md-6"><input type="text" class="form-control" placeholder="Invoice Number"></div>
                                <div class="col col-md-6"><button class="btn btn-success w-100">Confirm & Save</button></div>
                            </div>
                            <div class="card-actions float-end row">
                                <div class="col col-md-12">
                                    <input type="number" class="form-control" placeholder="Discount">
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Invoice</h5>
                        </div>
                        <table class="table table-borderless my-0">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Item code</th>
                                    <th>Item name</th>
                                    <th>Price</th>
                                    <th>Tax</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($confirmed as $item)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->pivot->due_price}}</td>
                                        <td>{{$item->pivot->due_tax}}</td>
                                        <td class="text-center">{{$item->pivot->quantity}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
