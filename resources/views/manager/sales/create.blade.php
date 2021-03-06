@extends('pageLayouts.admin')

@section('title')
    <title>Records | Sales</title>
@endsection

@section('content')
    <main class="content p-4" id="app">
        <div class="container-fluid p-0">
            <a href="/sales/1" class="btn btn-primary float-end mt-n1">View Records</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> New Sales Record</h1>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="customer-search">Customer</label>
                                    <input :disabled="customer != null" id="customer-search" placeholder="Find customer" v-model="customer_search" name="name" type="text" class="form-control">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="stock_id">Stock</label>
                                    <select :disabled="proforma.length > 0" v-model="stock_id" name="stock_id" class="form-select" required id="stock_id">
                                        <option value="">Select stock</option>
                                        @foreach (App\Models\Stock::all() as $stock)
                                            <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="item-search">Pick Items</label>
                                    <input id="item-search" placeholder="Enter item code" v-model="item_search" name="name" type="text" class="form-control">
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>

                <div class="col-12" v-if="searching">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <span class="spinner-border text-warning" role="status">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
             
                {{-- Search List --}}
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="card-title my-2">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Hide
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div v-if="!searching && results.length > 0">
                                <div v-if="`${item_search != '' || customer_search != ''}`">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div v-if="mode == 1" class="row">
                                                <table class="table">
                                                    <thead>
                                                        <th>Sn</th>
                                                        <th>Item</th>
                                                        <th>Description</th>
                                                        <th>Selling Price</th>
                                                        <th>Quantity</th>
                                                        <th>Add Item</th>
                                                    </thead>
                                                    <tr v-for="(item, index) in results">
                                                        <td>@{{index+1}}</td>
                                                        <td>@{{item.code}}</td>
                                                        <td>@{{item.desc}}</td>
                                                        <td>@{{item.selling_price}}</td>
                                                        <td><input type="number" min="0" v-model="item.quantity"></td>
                                                        <td><button v-on:click="addItem(index)" class="btn btn-primary"><i class="la la-plus"></i></button></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div v-else class="row">
                                                <table class="table">
                                                    <thead>
                                                        <th>Sn</th>
                                                        <th>Customer name</th>
                                                        <th>Customer email</th>
                                                        <th>Contact phone</th>
                                                        <th>Address</th>
                                                        <th>Select Customer</th>
                                                    </thead>
                                                    <tr v-for="(item, index) in results">
                                                        <td>@{{index+1}}</td>
                                                        <td>@{{item.name}}</td>
                                                        <td>@{{item.email}}</td>
                                                        <td>@{{item.phone}}</td>
                                                        <td>@{{item.address}}</td>
                                                        <td><button v-on:click="selectCustomer(index)" class="btn btn-primary"><i class="la la-check"></i></button></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             
                </div>
                </div>

                {{-- proforma section --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pt-4">
                            <div class="card-actions float-end">
                                <button :disabled="proforma.length==0 || validity=='' || due_date==''" v-on:click="saveProforma()" class="btn btn-success float-end mx-2 text-white">Save Proforma</button>
                            </div>
                            <div class="card-actions float-end">
                                <div class="row ">
                                    <div class="col col-md-6">
                                        <input v-model="validity" type="text" class="form-control" placeholder="Validity e.g 12 Days">
                                    </div>
                                    <div class="col col-md-6">
                                        <input v-model="due_date" type="text" class="form-control" placeholder="Due date">
                                    </div>
                                </div>
                            </div>

                           
                            <h5 class="card-title">Proforma Invoice</h5>
                            <h6 class="card-subtitle text-muted" v-if="customer != null">To: @{{customer.name}}<br>
                            @{{customer.phone}} - @{{customer.address}}
                            </h6>
                        </div>
                            <div class="card-body border-top">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <table v-if="proforma.length > 0" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in proforma" :key="'item' + index">
                                        <td>@{{index+1}}</td>
                                        <td>@{{item.code}}</td>
                                        <td>@{{item.desc}}</td>
                                        <td>@{{item.quantity}}</td>
                                        <td>@{{item.selling_price}}</td>
                                        <td>@{{totalRow(index)}}</td>
                                        <td>
                                            <button v-on:click="removeItem(index)" class="btn btn-danger"><i class="la la-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-center text-dark"><b>Total Amount</b></td>
                                        <td>@{{totalCost}}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                              
                            </table>
                        </div>
                    </div>
                </div>

            </div>


            {{-- <ul>
                <li>select customer / create if not existing</li>
                <li>create proforma - (by selecting items, set quantity)</li>
                <li>on create invoice btn clicked, prompt "any discount?"</li>
                <li>on receive payment clicked, prompt "On cash or On Credit?"</li>
                <li>Confirm & save</li>
            </ul> --}}
        </div>
    </main>


<script>
    var app = new Vue({
        el: '#app', 

        data(){
            return {
                proforma: [], customer: null, mode: '',
                item_search: '', customer_search: '', 
                results: [], searching: false, noResults: false,
                validity: "",
                due_date: "",
                stock_id: ""
            }
        }, 

        watch: {
            stock_id(c, o){
                if(c != o || c == ''){
                    this.proforma = [];
                    this.results = [];
                }
            },

            customer_search(c, o){
                if(c != ''){
                    this.mode = 0;
                    this.search(0);
                }
            },
            item_search(c, o){
                if(c != ''){
                    this.mode = 1;
                    this.search(1);
                }
            }, 
        },

        methods: {
            async saveProforma(){
                var items = [];
                for(var i = 0; i < this.proforma.length; i++){
                    items.push({
                        'item_id': this.proforma[i].id, 
                        'item_quantity': this.proforma[i].quantity, 
                        'due_price': this.proforma[i].selling_price,
                    });  //this.proforma[i].tax
                }
                var dataSet = {
                    'customer_id': this.customer.id,
                     'validity': this.validity, 
                     'due_date': this.due_date,
                    'items': items,
                    'stock_id':this.stock_id,
                }
                var requestOptions = {
                    method: "POST",
                    headers: { 
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    body: JSON.stringify(dataSet)
                };

                var response = await fetch(`/save_sales`, requestOptions);
                var data = await response.json();
                window.location.href = '/proforma/' + data;
            },

            selectCustomer(index){
                var selected = this.results[index];
                this.customer = selected;
                this.results = []; this.customer_search = '';
            },

            itemAvailable(index){
                var selected = this.results[index];
                var target = this.proforma.find(item => item.id == selected.id);
                return target != null;
            },

            addItem(index){
                var exists = this.itemAvailable(index);
                if(exists){
                    alert("Item already added!");
                }else{
                    var item = this.results[index];
                    if(item.quantity == undefined){
                        alert("Item Quantity required!");
                    }else{
                        this.proforma.push(item);
                        this.results.splice(index, 1);
                        this.item_search = "";
                    }
                }
            },

            removeItem(index){
                this.proforma.splice(index, 1);
            }, 

            totalRow(index){
                var tax = 0 //this.proforma[index].tax;
                var price = this.proforma[index].selling_price;
                var quantity = this.proforma[index].quantity;
                return (tax + price) * quantity;
            },

            search(mode) {
                // console.log('searching')
                this.searching = true;
                var endpoint = mode == 0 ? "customers" : "items";
                var text = mode == 0 ? this.customer_search : this.item_search;

                var requestOptionsSearch = {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({ item:this.item_search, id: this.stock_id })
                };

                if( endpoint == 'items'){

                fetch('/items/search', requestOptionsSearch )
                    .then(res => res.json())
                    .then(res => {
                        this.searching = false;
                        this.results = res;
                        this.noResults = this.results.length === 0;
                    });
                }else{

                fetch(`/${endpoint}/search/${encodeURIComponent(text)}`)
                    .then(res => res.json())
                    .then(res => {
                        this.searching = false;
                        this.results = res;
                        this.noResults = this.results.length === 0;
                    });
                }
            }
            
        }, 

        computed: {
            totalCost(){
                var total = 0;
                for(var i = 0; i < this.proforma.length; i++){
                    total += this.totalRow(i);
                }
                return total;
            }
        }
    });
</script>
@endsection
