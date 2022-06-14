@extends('pageLayouts.admin')

@section('title')
    <title>Records | Sales</title>
@endsection

@section('content')
    <main class="content" id="app">
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
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="customer-search">Customer</label>
                                    <input id="customer-search" placeholder="Find customer" v-model="customer_search" name="name" type="text" class="form-control">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="item-search">Pick Items</label>
                                    <input id="item-search" placeholder="Find items" v-model="item_search" name="name" type="text" class="form-control">
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
             
                <div v-if="!searching && results.length > 0">
                    <div v-if="item_search != ''">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                            <th>Sn</th>
                                            <th>Item name</th>
                                            <th>Selling Price</th>
                                            <th>Tax</th>
                                            <th>Quantity</th>
                                            <th>Add Item</th>
                                        </thead>
                                        <tr v-for="(item, index) in results">
                                            <td>@{{index+1}}</td>
                                            <td>@{{item.name}}</td>
                                            <td>@{{item.selling_price}}</td>
                                            <td>@{{item.tax}}</td>
                                            <td><input type="number" v-model="item.quantity"></td>
                                            <td><button v-on:click="addItem(index)" class="btn btn-primary"><i class="la la-plus"></i></button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header pt-4">
                            <a href="#" class="btn btn-success float-end mt-n1">Save Proforma</a>
                            <h5 class="card-title">Proforma Invoice</h5>
                            <h6 class="card-subtitle text-muted">To: Omi Laborta</h6>
                        </div>
                        <div class="card-body border-top">
                            <table v-if="proforma.length > 0" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Item code</th>
                                        <th>Item name</th>
                                        <th>Item quantity</th>
                                        <th>Tax</th>
                                        <th>Selling Price</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in proforma" :key="'item' + index">
                                        <td>@{{index+1}}</td>
                                        <td>@{{item.code}}</td>
                                        <td>@{{item.name}}</td>
                                        <td>@{{item.quantity}}</td>
                                        <td>@{{item.tax}}</td>
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
                proforma: [], customer: {},
                item_search: '', customer_search: '', 
                results: [], searching: false, noResults: false
            }
        }, 

        watch: {
            item_search(c, o){
                if(c != ''){
                    this.search();
                }
            }, 
            customer_search(c, o){
                if(c != ''){
                    this.search();
                }
            }
        },

        methods: {
            addItem(index){
                var item = this.results[index];
                this.proforma.push(item);
                this.results.splice(index, 1);
            },

            removeItem(index){
                this.proforma.splice(index, 1);
            }, 

            totalRow(index){
                var tax = this.proforma[index].tax;
                var price = this.proforma[index].selling_price;
                var quantity = this.proforma[index].quantity;
                return (tax + price) * quantity;
            },

            search: function() {
			this.searching = true;
			fetch(`/items/search/${encodeURIComponent(this.item_search)}`)
                .then(res => res.json())
                .then(res => {
                    this.searching = false;
                    this.results = res;
                    this.noResults = this.results.length === 0;
                });
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
