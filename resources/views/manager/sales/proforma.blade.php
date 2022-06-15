@extends('pageLayouts.admin')

@section('title')
    <title>Records | Proforma</title>
@endsection

@section('content')
    <main class="content" id="app">
        <div class="container-fluid p-0">

            <div class="mb-3">
                @if (sizeof($items) > 0)
                <a href="#" class="btn btn-dark float-end mt-n1"><i class="la la-print"></i> Print Proforma</a>
                @endif
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
                        <div class="card-header border-bottom">
                            <div class="card-actions float-end">
                                <button form="invoice" class="btn btn-success" type="submit"><i class="la la-sync"></i> Convert to Invoice</button>
                            </div>
                            <div class="card-actions float-end">
                                <button class="btn btn-info mx-2" form="undo" type="submit"><i class="la la-undo"></i> Undo</button>
                            </div>
                            <h5 class="card-title mb-0">Proforma</h5>
                        </div>
                        <form action="/sales/undo/{{$sale->id}}" method="POST" id="undo">
                            @csrf
                            @method('PUT')
                        </form>
                        <form id="invoice" action="/sales/make_invoice/{{$sale->id}}" method="post">
                        @csrf 
                        @method('PUT')
              
                        @if (sizeof($items) > 0)
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
                        @endif
                    </form>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xxl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header border-bottom">
                            <div class="card-actions float-end row">
                                <form action="/sales/confirm_invoice/{{$sale->id}}" method="POST" id="invoice-confirmation">
                                    @csrf
                                    @method('PUT')
                                    <div class="col col-md-12"><button :disabled="discount == 1" class="btn btn-success w-100" type="submit">Confirm & Save</button></div>
                                </form>
                            </div>
                            <div class="card-actions float-end row mx-1">
                                <div class="col col-md-12">  
                                    <form action="/sales/set_discount/{{$sale->id}}" method="POST" id="discount">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <input type="number" name="discount" v-on:keyup="setDiscount" v-on:change="setDiscount" required value="{{$sale->discount}}" class="form-control" placeholder="Total discount">
                                            <button form="discount" class="btn btn-primary" type="submit">Calculate</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Invoice</h5>
                        </div>
                        @if (sizeof($confirmed) > 0)
                        <table class="table table-borderless mt-0 mb-2">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Item code</th>
                                    <th>Item name</th>
                                    <th>Price</th>
                                    <th>Tax</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach ($confirmed as $item)
                                    @php
                                        $subtotal += ($item->pivot->due_price + $item->pivot->due_tax) * $item->pivot->quantity;
                                    @endphp
                                    <tr>
                                        <td>#</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->pivot->due_price}}</td>
                                        <td>{{$item->pivot->due_tax}}</td>
                                        <td class="text-center">{{$item->pivot->quantity}}</td>
                                        <td>{{ ($item->pivot->due_price + $item->pivot->due_tax) * $item->pivot->quantity}}</td>
                                    </tr>
                                @endforeach
                                <tr><td colspan="7" class="border-top"></td></tr>
                                <tr>
                                    <td colspan="5" class="font-weight-bold text-secondary">Subtotal</td>
                                    <td colspan="2" class="text-end">{{number_format($subtotal, 2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="font-weight-bold text-secondary" >Discount</td>
                                    <td colspan="2" class="text-end">{{number_format($sale->discount, 2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="font-weight-bold text-dark h4">Total Amount</td>
                                    <td colspan="2" class="text-end border-top border-bottom">{{number_format($subtotal - $sale->discount, 2)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script>
        var app = new Vue({
            el: '#app', 
            data() {
                return {
                    discount: 0
                }
            }, 
            watch: {
                discount(c, o){
                    console.log(c);
                }
            },
            methods: {
                setDiscount(){
                    this.discount = 1;
                    console.log(this.discount)
                }
            }
        });
    </script>
@endsection
