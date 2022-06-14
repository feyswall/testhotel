@extends('pageLayouts.admin')

@section('title')
    <title>Records | Sales On {{ $mode == 0 ? 'Credit' : 'Cash'}}</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="/new_sales" class="btn btn-primary float-end mt-n1">New Record</a>
            <a href="/sales/0" class="btn {{$mode == 0 ? 'btn-danger': 'btn-outline-danger'}} float-end mt-n1 mx-3">Sales On Credit</a>
            <a href="/sales/1" class="btn {{$mode == 1 ? 'btn-success' : 'btn-outline-success'}} float-end mt-n1">Sales On Cash</a>
            <a href="/sales/2" class="btn {{$mode != 1 && $mode != 0 ? 'btn-warning' : 'btn-outline-warning'}} mx-3 float-end mt-n1">Sales Orders</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Sales On {{ $mode == 0 ? 'Credit' : 'Cash'}}</h1>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $sales as $sale )                                    
                                    <tr>
                                        @php  
                                        $gross = 0;  
                                        $total_due_tax = 0;
                                        foreach( $sale->items as $item ){
                                            $total_due_tax += $item->pivot->due_tax; 
                                            $gross = ($item->pivot->due_price + $item->pivot->due_tax) * $item->pivot->quantity;
                                        }

                                        @endphp
                                        <td>{{ $sale->customer->name }}</td>
                                        <td> {{ number_format($gross) }}/=</td>
                                        <td>{{ number_format($total_due_tax) }}</td>
                                        <td>{{ $sale->discount }}</td>
                                        <td>{{ number_format($gross - $total_due_tax - $sale->discount) }}</td>
                                        <td>{{ $sale->created_at}}</td>
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
