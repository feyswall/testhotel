@extends('pageLayouts.admin')

@section('title')
    <title>Records | Proforma</title>
@endsection

@section('content')
    <main class="content p-4" id="app">
        <div class="container-fluid p-0">

            <div class="mb-3">
                @if (sizeof($confirmed) > 0)
                <a href="#" onclick="printInvoice('printable-proforma')" class="btn btn-dark float-end mt-n1"><i class="la la-print"></i> Print Proforma</a>
                @endif
                <a href="/sales/2" class="btn btn-outline-primary float-end mt-n1 mx-2"><i class="la la-arrow-left"></i> Back To List</a>
                <h1 class="h3 d-inline align-middle font-weight-bold">Prepare Invoice</h1>
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
                            @if(sizeof($items) == 0)
                            <div class="card-actions float-end">
                                <button class="btn btn-info mx-2" form="undo" type="submit"><i class="la la-undo"></i> Undo</button>
                            </div>
                            @endif  
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
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->desc}}</td>
                                        <td>{{number_format($item->pivot->due_price, 2)}}</td>
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
                                    <div class="col col-md-12">
                                        <button :disabled="discount == 1" class="btn btn-success w-100" type="submit">Confirm & Save</button></div>
                                </form>
                            </div>
                            <div class="card-actions float-end row mx-1">
                                <div class="col col-md-12">  
                                    <form action="/sales/set_discount/{{$sale->id}}" method="POST" id="discount">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <input type="number" name="discount" v-on:keyup="setDiscount" min="0" v-on:change="setDiscount" required class="form-control" placeholder="Total discount">
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
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($confirmed as $item)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->desc}}</td>
                                        <td>{{number_format($item->pivot->due_price, 2 )}}</td>
                                        <td class="text-center">{{$item->pivot->quantity}}</td>
                                        <td>{{ number_format($purchase->current->total_item_income($item), 2)}}</td>
                                    </tr>
                                @endforeach
                                <tr><td colspan="7" class="border-top"></td></tr>
                                <tr>
                                    <td colspan="5" class="font-weight-bold text-secondary">Subtotal</td>
                                    <td colspan="2" class="text-end">{{number_format($purchase->subtotal, 2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="font-weight-bold text-secondary">VAT Total 10%)</td>
                                    <td colspan="2" class="text-end">{{number_format($purchase->vat_total, 2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="font-weight-bold text-secondary" >Discount</td>
                                    <td colspan="2" class="text-end">{{number_format($sale->discount, 2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="font-weight-bold text-dark h4">Total Amount</td>
                                    <td colspan="2" class="text-end border-top border-bottom">{{number_format($purchase->discounted, 2)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </main>


    <div class="d-none">
        <div class="row" id="printable-proforma">
            <div class="col-12">
                <div class="card shadow-none">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-5">
                                <img src="{{ asset('assets/img/avatars/logo-dark.png') }}" alt="" width="80%" height="100%">
                            </div>
                            <div class="col col-md-7 text-md-end">
                                <h1 class="text-dark broadway">Proforma Invoice</h1>
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
                                        <td class="text-start">P.I NUMBER: {{$sale->pi_number}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">TIN: {{$customer->tin}}</td>
                                        <td class="text-start">VRN: {{$customer->vrn}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">ZRB:</td>
                                        <td class="text-start">{{$customer->zrb}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">VALIDITY: {{$sale->validity}}</td>
                                        <td class="text-start">Due Date: {{$sale->due_date}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col col-md-7">
                                <table class="table table-sm table-bordered mini-text">
                                    <tr>
                                        <td class="text-start">To: </td>
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
                        </div>

                        <div class="row mt-n3">
                            <div class="col col-md-12">
                                <table class="table table-sm table-bordered mini-text">
                                    <tr>
                                        <td class="text-center">NO.</td>
                                        <td class="text-center">ITEM</td>
                                        <td class="text-start">DESCRIPTION</td>
                                        <td class="text-center">QTY</td>
                                        <td class="text-center">PRICE</td>
                                        <td class="text-center">TOTAL</td>
                                    </tr>
                                    @php
                                        $tax_total = 0; 
                                    @endphp
                                    @foreach ($confirmed as $item)
                                    @php
                                        $tax_total += 0;
                                        // $tax_category = Tax::where('type', )
                                    @endphp
                                        <tr>
                                            <td class="text-center">#</td>
                                            <td class="text-center">{{$item->code}}</td>
                                            <td>{{$item->desc}}</td>
                                            <td class="text-center">{{$item->pivot->quantity}}</td>
                                            <td class="text-center">{{number_format($item->selling_price, 2)}}</td>
                                            <td class="text-center">{{number_format( $purchase->current->total_item_income($item), 2)}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="bg-light text-end">SUBTOTAL:</td>
                                        <td colspan="3" class="text-start text-end">{{ number_format($purchase->subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="bg-light text-end">VAT TOTAL ({{ $vat_rate }}%):</td>
                                        <td colspan="3" class="text-start text-end">{{number_format($purchase->vat_total, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="bg-light text-end">TOTAL:</td>
                                        <td colspan="3" class="text-start text-end"> {{ number_format($purchase->discounted, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var app = new Vue({
            el: '#app', 
            data() {
                return {
                    discount: 0
                }
            }, 
            methods: {
                setDiscount(){
                    this.discount = 1;
                }
            }
        });
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
