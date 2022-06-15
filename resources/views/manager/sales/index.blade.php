@extends('pageLayouts.admin')

@section('title')
    <title>Records | {{($mode == 2) ? 'Sales Orders' : ($mode == 0 ? 'Sales On Credit' : 'Sales On Cash') }}</title>
@endsection

@section('content')
    <main class="content">
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
                                        <th>Sales Date</th>
                                        <th>Options</th>
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
                                        <td>{{ date_format(date_create($sale->created_at), 'M d, Y. H:i') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Options
                                            </button>
                                            <div class="dropdown-menu">
                                                @if ($sale->cash_mode == 0 || ($sale->invoice_number != null && $sale->cash_mode == 0))
                                                <a class="dropdown-item" href="#">Print Invoice</a>
                                                <a class="dropdown-item" href="#">Receive Payment</a>
                                                @elseif($sale->cash_mode == 2)
                                                <a class="dropdown-item" href="#">Print Proforma</a>
                                                <a class="dropdown-item" href="#">Generate Invoice</a>
                                                @else 
                                                <a class="dropdown-item" href="#">View Record</a>
                                                @endif
                                            </div>
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
