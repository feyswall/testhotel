
@extends('pageLayouts.admin')

@section('title')
    <title>Inventory | Items</title>
@endsection

@section('content')
     <main class="content p-4" id="app">
        <div class="container-fluid p-0">
            <a href="{{ route('complementary.out.stock') }}" class="btn btn-primary float-end mt-n1">All Complementary</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> New Complementary</h1>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="selling_price">From Stock</label>
                            <select :disabled="stock_out.length > 0" v-model="stock_id" name="stock_id" class="form-select" required id="stock_id">
                                <option value="">Select stock</option>
                                @foreach (App\Models\Stock::all() as $stock)
                                    <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                @endforeach
                            </select>
                            @error('stock_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="stock_mode">Recording for</label>
                            <select :disabled="stock_id == '' ||stock_out.length > 0" v-model="stock_mode" class="form-select" id="stock_mode">
                                <option value="">Select mode</option>
                                @foreach ($modes as $mode)
                                    <option value="{{ $mode->id }}">{{ $mode->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="search_bar">Search</label>
                            <input :disabled="stock_mode == ''" type="text" v-model="item_search" @keyup.enter="search()" placeholder="Search items" class="form-control" id="search_bar">
                        </div>
                        <div class="mb-3 col-md-2" v-if="results.length > 0">
                            <label class="form-label" for="close_button">Clear results</label>
                            <div id="close_button">
                                <button class="btn btn-danger w-100 text-white" v-on:click="closeTable()"><i class="la la-close"></i></button>
                            </div>
                        </div>
                    </div>
                    <div v-if="results.length > 0">
                        <div v-if="`${item_search != ''}`">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div v-if="results.length > 0" class="row">
                                            <table class="table">
                                                <thead>
                                                    <th>Sn</th>
                                                    <th>Item</th>
                                                    <th>Description</th>
                                                    <th>Quantity</th>
                                                    <th>Stock Date</th>
                                                    <th>Details</th>
                                                    <th>Add Item</th>
                                                </thead>
                                                <tr v-for="(item, index) in results">
                                                    <td>@{{index+1}}</td>
                                                    <td>@{{item.code}}</td>
                                                    <td style="width: 30%">@{{item.desc}}</td>
                                                    <td>0</td>
                                                    <td>-</td>
                                                    <td><input type="text" v-model="item.details" placeholder="Details" class="form-control"></td>
                                                    <td><button v-on:click="addItem(index)" class="btn btn-primary"><i class="la la-plus"></i></button></td>
                                                </tr>
                                            </table>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table v-if="stock_out.length > 0" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Stock Date</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in stock_out" :key="'itemout' + index">
                                <td>@{{index+1}}</td>
                                <td>@{{item.code}}</td>
                                <td>@{{item.desc}}</td>
                                <td>@{{item.quantity}}</td>
                                <td>
                                    {{-- <input disabled class="form-control" type="date" href="#" data-bs-toggle="modal" data-bs-target="#issuing-modal-{{$item->id}}" placeholder="Stock date">
                                    <div class="modal fade" id="issuing-modal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-muted">Issuing of {{$item->desc}}</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body m-3">
                                                    <table class="table table-condensed">
                                                        <thead>
                                                            <th>Date Added</th>
                                                            <th>Initial QTY</th>
                                                            <th>Balance QTY</th>
                                                            <th>Issuing QTY</th>
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
                                                                <td class="d-none"><input disabled value="{{$inStock->id}}" type="text" id="instock-{{$count}}-{{$item->id}}"></td>
                                                                <td><input class="form-control border-0 bg-white" disabled type="text" value="{{$inStock->created_at}}" id="indate-{{$count}}-{{$item->id}}"></td>
                                                                <td>{{ SalesController::initialQuantity( $inStock ) }}</td>
                                                                <td>{{ SalesController::currentQuantity( $inStock ) }}</td>
                                                                <td><input id="sel_qty-{{$count}}-{{$item->id}}" type="number" min="0" class="form-control"></td>  
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
                                    </div> --}}
                                </td>
                                <td>@{{item.details}}</td>
                                <td>
                                    <button v-on:click="removeItem(index)" class="btn btn-danger"><i class="la la-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        
                    </table>
            </div>
        </div>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </main>

    <script>
        const app = new Vue({
            el: "#app",
            
            data(){
                return {
                    items: [],
                    results: [],
                    stock_id: '',
                    stock_mode: '', 
                    item_search: '', 
                    searching: false,
                    stock_out: [],
                }
            },

            watch: {
                item_search(c, o){
                    if(c == ''){
                        this.results = [];
                    }
                }
            },

            methods: {
                closeTable(){
                    this.results = [];
                    this.item_search = "";
                },

                itemAvailable(index){
                    var selected = this.results[index];
                    var target = this.stock_out.find(item => item.id == selected.id);
                    return target != null;
                },

                addItem(index){
                    var exists = this.itemAvailable(index);
                    if(exists){
                        alert("Item already added!");
                    }else{
                        var item = this.results[index];
                        this.stock_out.push(item);
                        this.results.splice(index, 1);
                    }
                },

                removeItem(index){
                    this.stock_out.splice(index, 1);
                }, 
                
                fillItems(){
                    var requestOptionsSearch = {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF                                                                                                                                                                                                                                                                                                                                                                                                                           -TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify({ stock_id: this.stock_id })
                    };
                    fetch('/stock/items/search', requestOptionsSearch )
                    .then(res => res.json())
                    .then(res => {
                        this.items = res;
                    });
                }, 

                search() {
                    if(this.stock_id == ''){
                        alert("Select stock");
                    }else if(this.item_search == ''){
                        this.results = [];
                    }else{
                        this.searching = true;
                        var requestOptionsSearch = {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({ item:this.item_search, id: this.stock_id })
                        };

                        fetch('/items/search', requestOptionsSearch )
                            .then(res => res.json())
                            .then(res => {
                                this.searching = false;
                                this.results = res;
                                this.noResults = this.results.length === 0;
                        });
                    }
                },
            }
        });
    </script>
@endsection
