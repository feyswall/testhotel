@extends('pageLayouts.admin')

@section('title')
    <title>Records | Preview</title>
@endsection

@section('content')
    <main class="content p-4" id="app">
        <div class="container-fluid p-0">
            <a href="#" onclick="printInvoice('taxinvoice')" class="btn btn-primary float-end mt-n1">Print Invoice</a>
            <a href="/sales/2" class="btn btn-outline-primary float-end mt-n1 mx-2"><i class="la la-arrow-left"></i> Back To List</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle font-weight-bold">
                    Tax Invoice    
                </h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">Customer Details</h5>
                        </div>
                        <div class="card-body">
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">Items</h5>
                        </div>
                        <div class="card-body mt-n3">
                            <table id="datatables-button" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $sale->items as $item )
                                    <tr>
                                        <td>#</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->desc}}</td>
                                        <td>{{number_format($item->pivot->due_price, 2)}}</td>
                                        <td>{{$item->pivot->quantity}}</td>
                                        <td class="text-end">{{number_format($item->pivot->quantity * $item->pivot->due_price, 2)}}</td>
                                    </tr>
                                    @endforeach
                                    <tr><td colspan="6" style="border-bottom: 3px solid #f1b756"></td></tr>
                                    <tr>
                                        <td colspan="4" class="font-weight-bold text-end text-secondary">Subtotal</td>
                                        <td colspan="2" class="text-end">{{number_format($purchase->subtotal, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="font-weight-bold text-end text-secondary">VAT Total ({{$vat_rate}}%)</td>
                                        <td colspan="2" class="text-end">{{number_format($purchase->vat_total, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="font-weight-bold text-end text-secondary" >Discount</td>
                                        <td colspan="2" class="text-end">{{number_format($sale->discount, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="font-weight-bold text-end text-dark h4">Total Amount</td>
                                        <td colspan="2" class="text-end border-top border-bottom">{{number_format($purchase->discounted, 2)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
        </div>

        <div class="container-fluid p-0 d-none">
            <div class="row" id="taxinvoice">
                <div class="col-12">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-5">
                                    <img src="{{ asset('assets/img/avatars/logo-dark.png') }}" alt="" width="80%" height="100%">
                                </div>
                                <div class="col col-md-7 text-md-end">
                                    <h1 class="text-dark broadway">Tax Invoice</h1>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col col-md-5">
                                    <address class="mini-text">
                                        {{$setting['box'] ?? ""}},<br>
                                        {{$setting['street'] ?? ""}}<br>
                                        {{$setting['state'] ?? ""}}<br>
                                        Phone: {{$setting['phone'] ?? ""}}<br>
                                        Email: {{$setting['email'] ?? ""}}<br>
                                        Website: <a href="#">{{$setting['website'] ?? ""}}</a><br>
                                    </address>
                                </div>
                                <div class="col col-md-7 text-md-end">
                                    <table class="table table-sm table-bordered table-responsive mini-text">
                                        <tr>
                                            <td class="text-start">DATE: {{date('M d, Y')}}</td>
                                            <td class="text-start">INVOICE NUMBER: {{$sale->invoice_number}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">TIN: {{$customer->tin}}</td>
                                            <td class="text-start">VRN: {{$customer->vrn}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col col-md-7">
                                    <table class="table table-sm table-bordered mini-text">
                                        <tr>
                                            <td class="text-start">Sold To: </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">
                                                {{$customer->name}} <br>
                                                {{$customer->phone}} <br>
                                                {{$customer->address}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col col-md-5 text-md-end">
                                    <table class="table table-bordered mini-text table-sm">
                                        <tr>
                                            <td class="text-center">Cheque No</td>
                                            <td class="text-center">Payment Method</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{$sale->payment_method->name ?? '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row mt-n3">
                                <div class="col col-md-12">
                                    <table class="table table-sm table-borderless mini-text mt-3">
                                        <tr>
                                            <td class="text-start">NO.</td>
                                            <td class="text-start">ITEM</td>
                                            <td class="text-start">DESCRIPTION</td>
                                            <td class="text-center">QTY</td>
                                            <td class="text-center">PRICE</td>
                                            <td class="text-end">TOTAL</td>
                                        </tr>
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($sale->items as $item)
                                        <tr>
                                            <td>{{++$counter}}</td>
                                            <td>{{$item->code}}</td>
                                            <td>{{$item->desc}}</td>
                                            <td class="text-center">{{$item->pivot->quantity}}</td>
                                            <td class="text-center">{{number_format($item->pivot->due_price, 2)}}</td>
                                            <td class="text-end">{{number_format($item->pivot->quantity * $item->pivot->due_price, 2)}}</td>
                                        </tr>
                                        @endforeach
                                        <tr><td colspan="6" class="border-bottom"></td></tr>
                                        <tr>
                                            <td colspan="3" class="text-end">SUBTOTAL: </td>
                                            <td colspan="3" class="text-start text-end">{{ number_format($purchase->subtotal, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class=" text-end">VAT TOTAL ({{ $vat_rate }}%): </td>
                                            <td colspan="3" class="text-start text-end">{{number_format($purchase->vat_total, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class=" text-end">DISCOUNT TOTAL: </td>
                                            <td colspan="3" class="text-start text-end">{{number_format($sale->discount, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end h6">TOTAL: </td>
                                            <td colspan="3" class="text-start text-end h6 border-top border-bottom">{{ number_format($purchase->discounted, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        var app = new Vue({
            el: '#app', 
            data(){
                return {

                }
            },
            methods: {
               async removeOrder(id){
                    var requestOptions = {
                    method: "DELETE",
                    headers: { 
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    };

                    var response = await fetch(`/remove_order/${id}`, requestOptions);
                    var data = await response.json();
                    window.location.reload();
                }
            },
        });
    </script>
    <script>
               
        let cash_check_element = document.querySelector('#cashCheck');
        cash_check_element.onchange = function(){;
           document.querySelector('#cashIn').style.display = 'block';
        }

        let credit_check_element = document.querySelector('#creditCheck');
        credit_check_element.onchange = function(){
           document.querySelector('#cashIn').style.display = 'none';
        }
    </script>
     <script>
        function printInvoice(id) {
            var element = document.getElementById(id);
            var opt = {
            margin:       [0.3, 0.3, 0.3, 0.8],
            filename:     'myfile.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 1 },
            jsPDF:        { unit: 'cm', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
@endsection
