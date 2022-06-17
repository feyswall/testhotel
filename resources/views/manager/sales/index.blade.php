@extends('pageLayouts.admin')

@section('title')
    <title>Records | {{($mode == 2) ? 'Sales Orders' : ($mode == 0 ? 'Sales On Credit' : 'Sales On Cash') }}</title>
@endsection

@section('content')
    <main class="content" id="app">
        <div class="container-fluid p-0">
            <a href="/new_sales" class="btn btn-primary float-end mt-n1">New Record</a>
            <a href="/sales/1" class="btn {{$mode == 1 ? 'btn-success' : 'btn-outline-success'}} float-end mt-n1 mx-3">Sales On Cash</a>
            <a href="/sales/0" class="btn {{$mode == 0 ? 'btn-danger': 'btn-outline-danger'}} float-end mt-n1">Sales On Credit</a>
            <a href="/sales/2" class="btn {{$mode == 2 ? 'btn-dark' : 'btn-outline-dark'}} mx-3 float-end mt-n1">Sales Orders</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">{{ ($mode == 2) ? 'Sales Orders' : ($mode == 1 ? 'Sales On Cash' : "Sales On Credit") }}</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-buttons" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Gross</th>
                                        <th>Tax</th>
                                        <th>Discount</th>
                                        <th>Net</th>
                                        <th>Status</th>
                                        <th>Sales Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $sales as $sale )
                                    <tr>
                                        @php
                                        $gross = 0;
                                        $total_due_tax = 0;
                                        foreach( $sale->items as $item ){
                                            $total_due_tax += $item->pivot->due_tax * $item->pivot->quantity;
                                            $gross += ($item->pivot->due_price + $item->pivot->due_tax) * $item->pivot->quantity;
                                        }

                                        @endphp
                                        <td>{{ $sale->customer->name }}</td>
                                        <td> {{ number_format($gross, 2) }}</td>
                                        <td>{{ number_format($total_due_tax, 2) }}</td>
                                        <td>{{ $sale->discount }}</td>
                                        <td>{{ number_format($gross - $total_due_tax - $sale->discount, 2) }}</td>
                                        <td>
                                            <a class="badge @if($sale->invoice_number != null) bg-success @else bg-warning @endif ms-2" href="#">
                                                @if ($sale->invoice_number != null)
                                                    has invoice
                                                @else
                                                    no invoice
                                                @endif
                                            </a>
                                        </td>
                                        <td>{{ date_format(date_create($sale->created_at), 'M d, Y. H:i') }}</td>
                                        <td>
                                            <button type="button" class="btn
                                            @if($sale->invoice_number != null && $sale->cash_mode == 2) btn-outline-success @else btn-outline-secondary @endif
                                             btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Options
                                            </button>
                                            <button v-on:click="removeOrder({{$sale->id}})" class="btn btn-danger btn-sm">
                                                <i class="la la-trash"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @if($sale->invoice_number != null && $sale->cash_mode == 2)
                                                    <a class="dropdown-item" href="{{ route('print.sales.invoice', $sale->id) }}">Print Invoice</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#receive-payment-{{$sale->id}}" href="#">Receive Payment</a>
                                                @elseif($sale->invoice_number == null && $sale->cash_mode == 2)
                                                    <a class="dropdown-item" href="#">Print Proforma</a>
                                                    <a class="dropdown-item" href="/proforma/{{$sale->id}}">Generate Invoice</a>
                                                @elseif($sale->invoice_number != null && $sale->cash_mode == 0 )
                                                    <a class="dropdown-item" href="#">View Record</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#receive-payment-{{$sale->id}}" href="#">Receive Payment</a>
                                                @else
                                                    <a class="dropdown-item" href="#">View Record</a>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="receive-payment-{{$sale->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Receive payment from <span class="font-weight-bold">{{$sale->customer->name}}</span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body m-3">

                                                  <form method="POST" action="/sales/set_cash/{{$sale->id}}" id="cash-mode-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="radio" value="0" name="cash_mode">
                                                        <span class="form-check-label">
                                                            Record as sales on credit
                                                        </span>
                                                    </label>
                                                    <hr>
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="radio" value="1" name="cash_mode">
                                                        <span class="form-check-label">
                                                            Record as sales on cash
                                                        </span>
                                                    </label>
                                                  </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button form="cash-mode-form" type="submit" class="btn btn-success">Confirm Payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
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
@endsection
