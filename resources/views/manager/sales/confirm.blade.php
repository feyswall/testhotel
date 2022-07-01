@php
    use Illuminate\Support\Facades\DB;
    use App\Http\Controllers\Admin\SalesController;
    use App\Models\InStock;
@endphp
 
@extends('pageLayouts.admin')

@section('title')
    <title>Records | Confirm Sales</title>
@endsection

@section('content')
    <main class="content p-4" id="app">
        <div class="container-fluid p-0">
            <a href="/sales/2" class="btn btn-primary float-end mt-n1">View Records</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Confirm Sales</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="cash_mode">Receive Payment</label>
                                    <select name="cash_mode" v-model="cash_mode" id="cash_mode" class="form-control">
                                        <option value="">Recieve payment</option>
                                        <option value="0">Record as sales on credit</option>
                                        <option value="1">Record as sales on cash</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4" v-if="cash_mode == 1">
                                    <label for="method" class="form-label">Payment Method</label>
                                    <select v-model="payment_method" class="form-control" name="method" id="method">
                                        <option value="">Choose method</option>
                                        @foreach( App\Models\PaymentMethod::all() as $method )
                                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                           
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title text-muted">Stock Issuing</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-condensed" id="issuing-table">
                                <thead>
                                    <th>Sn</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Invoiced Qty</th>
                                    <th>Stock</th>
                                    <th>Issued Qty</th>
                                    <th>Issued From</th>
                                    <th>Action</th>
                                </thead>
                                <tbody class="panel">
                                    @php
                                        $counter = 0;
                                    @endphp
 
                                        <tr v-for="(item, key) in sale_items" :key="key">
                                            <td>{{ ++$counter }}</td>
                                            <td>@{{ item.code }}</td>
                                            <td>@{{ item.desc }}</td>
                                            <td>@{{ item.pivot.quantity }}</td>
                                            <td>stock name</td>
                                            <td>2, 3</td>
                                            <td>02-06-22, 03-06-22</td>
                                            <td :data-item="item.id">
                                                <a class="btn btn-primary" v-on:click="modelClick($event)" href="#" data-bs-toggle="modal" :data-bs-target="'#issuing-modal-'+item.id">Issue Items</a>
                                                <div class="modal fade" :id="'issuing-modal-'+item.id" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Stock items issuing</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body m-3">
                                                                <table class="table table-condensed">
                                                                    <thead>
                                                                        <th>#</th>
                                                                        <th>Date</th>
                                                                        <th>Initial Quantity</th>
                                                                        <th>Current Quantity</th>
                                                                        <th>Take</th>
                                                                    </thead>
                                                                    <tbody>
                                                                    {{-- @foreach ($inStocks as $key=>$inStock)
                                                                        <tr>
                                                                            <td>{{ ++$key }}</td>
                                                                            <td>{{ \Carbon\Carbon::parse($inStock->created_at)->format('M-d Y') }}</td>    
                                                                            <td>{{ SalesController::initialQuantity($inStock) }}</td>
                                                                            <td>{{ SalesController::currentQuantity($inStock) }}</td>
                                                                            <td>
                                                                                <form id="" action="">
                                                                                    <input type="number" value="quantity">
                                                                                </form>
                                                                            </td>
                                                                        </tr>    
                                                                    @endforeach --}}
                                                                    </tbody>
                                                                </table>
                                                            </div>
        
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button form="cash-mode-form" type="submit" class="btn btn-success">Confirm Payment</button>
                                                                </div>
        
                                                            </div>
        
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                     

                                </tbody>
                            </table>
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
              cash_mode: '',
               payment_method: '',
              sale_items: {!! json_encode( $sale->items ) !!},
            }
        }, 
        methods: {
            modelClick: function(event){
                console.log( event.target.parentElement.getAttribute('data-item') );

                   for( var g=0; g < this.sale_items.length; g++){
                       console.log( this.sale_items[g] );
                       this.searchInstock( {{ $sale->stock_id }}, this.sale_items[g].id );
                   }
                   
            },
            searchInstock: function(stock, item){
                    var requestOptions = {
                    method: "GET",
                    headers: { 
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                };
                fetch(`/search/in/stock/${stock}/${item}`)
                .then(res => res.json())
                .then(res => {
                    console.log( res );
                });
            }
        }

    });
</script>
@endsection
