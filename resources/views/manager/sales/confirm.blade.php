@php
    use Illuminate\Support\Facades\DB;
    use App\Http\Controllers\Admin\SalesController;
    use App\Models\InStock;
    use App\Http\Controllers\Admin\ItemController;
    use App\Http\Controllers\Admin\StocksController;
    use App\Http\Controllers\Admin\ItemController;
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
                            <div class="card-actions float-end">
                                <button class="btn btn-success" type="submit" v-on:click="updateSaleIssue()">Cofirm Sales</button>
                            </div>
                            <h5 class="card-title text-muted">Stock Issuing</h5>
                            <h6 class="card-subtitle text-muted">Stock Name: {{ $sale->id }}</h6>
                        </div>
                        <div class="card-body">
                              <table class="table table-condensed" id="issuing-table">
                                <thead>
                                    <th>Sn</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Invoiced Qty</th>
                                    <th>Issued Qty</th>
                                    <th>Issued From</th>
                                    <th>Action</th>
                                </thead>
                                <tbody class="panel">
                                    @php
                                        $count = 0;
                                    @endphp
                                  
                                    @foreach ($sale->items as $item)
                                        <tr>
                                            <td>{{ ++$count }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->desc }}</td>
                                            <td>{{ $item->pivot->quantity }}</td>
                                            <td>{{ itemQuantity(<?php echo $item->id; ?>) }}</td>
                                            <td>{{ itemIssueDates(<?php echo $item->id; ?>) }}</td>
                                            <td>
                                                <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#issuing-modal-{{$item->id}}">Issue Items</a>
                                                <div class="modal fade" id="issuing-modal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                        @php
                                                                            $count = 0;
                                                                        @endphp

                                                                        @foreach (InStock::where('item_id', $item->id)->get() as $inStock)
                                                                        @php
                                                                            ++$count;
                                                                        @endphp
                                                                        <tr>
                                                                            <td><input disabled value="{{$inStock->id}}" type="text" id="instock-{{$count}}"></td>
                                                                            <td><input disabled type="text" value="{{$inStock->created_at}}" id="indate-{{$count}}"></td>
                                                                            <td>{{ SalesController::initialQuantity( $inStock ) }}</td>
                                                                            <td>{{ SalesController::currentQuantity( $inStock ) }}</td>
                                                                            <td><input id="sel_qty-{{$count}}" type="number" class="form-control"></td>  
                                                                        </tr>    
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>
                                                            </div>
        
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button data-bs-dismiss="modal" form="cash-mode-form" v-on:click="addSelected('<?php echo $item->id; ?>', '<?php echo $count; ?>')" type="submit" class="btn btn-success">Confirm Payment</button>
                                                                </div>
        
                                                            </div>
        
                                                        </div>
                                                    </div>
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

    <meta name="stock_id" content="{{ $sale->stock_id }}">
    </main>

<script>
    var app = new Vue({
        el: '#app', 

        data(){
            return {
                cash_mode: '',
                payment_method: '',
                sale_items: {!! json_encode( $sale->items ) !!},
                inStocks: [],
                stockValues: '',
                selectedPacks: [], 
            }
        }, 


        computed: {
            itemIssueDates(){
                return id => {
                    var target = this.selectedPacks.filter(el => el.id.toString() == id.toString());
                    if(target != undefined){
                        if(target.length == 0){ return ""; };
                        var selected = [];
                        for(var i = 0; i < target.length; i++){
                            selected.push(target[i].date)
                        }
                        return selected;
                    }
                    return "";
                }
            },

            itemQuantity(){
                return id => {
                    var target = this.selectedPacks.filter(el => el.id.toString() == id.toString());
                    if(target != undefined){
                        if(target.length == 0){ return 0; };
                        var selected = [];
                        for(var i = 0; i < target.length; i++){
                            selected.push(parseInt(target[i].qty))
                        }
                        return selected;
                    }
                    return 0;
                }
            }
        },

        methods: {
            addSelected(itemId, count){
                var targets = this.selectedPacks.filter(item => item.id == itemId);
                if(targets != undefined){
                    for(var i = 0; i < targets.length; i++){
                        var index = this.selectedPacks.indexOf(targets[i]);
                        this.selectedPacks.splice(index, 1);
                    }
                }
                for(var i = 0; i < count; i++){
                    var qty = document.querySelector(`#sel_qty-${i+1}`).value;
                    var inStockId = document.querySelector(`#instock-${i+1}`).value;
                    var inStockDate = document.querySelector(`#indate-${i+1}`).value;
                    if(qty != ''){
                        this.selectedPacks.push({
                            id: itemId, inStockId: inStockId, qty: qty, date: inStockDate
                        });
                    }
                }
            }, 

            inStockProps(id, key) {
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
                    this.inStocks = res;
                });
            },

            searchInStock: function(item){
                var stock = $('meta[name="stock_id"]').attr('content');
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
                    this.inStocks = res;
                });
            },

            inStockFunct: function(instock){
                var requestOptions = {
                    method: "GET",
                    headers: { 
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                };
                fetch(`/in/stock/props/${instock}`)
                .then(res => res.json())
                .then(res => {
                    // this.inStockValue = res;
                   this.stockValues = res;
                   console.log( this.stockValues.created_at );
                   return res;
                });
            },

            updateSaleIssue: function(){
                let sale_id = {{ $sale->id }};
                let stock_id = {{ $sale->stock_id }};
                var requestOptions = {
                    method: "put",
                    headers: { 
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    body: JSON.stringify({
                         selectedPacks: this.selectedPacks,
                          sale_id: sale_id,
                          payment_method: this.payment_method,
                          cash_mode: this.cash_mode,
                         }),
                };
                fetch(`/issue/stock/update/${stock_id}`, requestOptions)
                .then(res => res.json())
                .then(res => {
                   if(res[0] == 'error'){
                       if( res[1] == 'exists'){
                            location.href = 'sales/2';
                       }else{
                            alert( res[1] );
                       }
                   }else if( res[0] == 'validation'){
                    alert( res[1][0] )
                   }else if('success'){
                       location.href = '/sales/2';
                   }
                });
            }
        }
    });
</script>
@endsection
