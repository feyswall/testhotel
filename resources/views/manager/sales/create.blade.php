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
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="customer-search">Customer</label>
                                    <select :disabled="proforma.length > 0" id="customer-search" class="form-control choices-single">
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                        <optgroup label="Pacific Time Zone">
                                            <option value="CA">California</option>
                                            <option value="NV">Nevada</option>
                                            <option value="OR">Oregon</option>
                                            <option value="WA">Washington</option>
                                        </optgroup>
                                        <optgroup label="Mountain Time Zone">
                                            <option value="AZ">Arizona</option>
                                            <option value="CO">Colorado</option>
                                            <option value="ID">Idaho</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="UT">Utah</option>
                                            <option value="WY">Wyoming</option>
                                        </optgroup>
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TX">Texas</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="WI">Wisconsin</option>
                                        </optgroup>
                                        <optgroup label="Eastern Time Zone">
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="IN">Indiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="OH">Ohio</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WV">West Virginia</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="item-search">Pick Items</label>
                                    <select id="item-search" class="form-control choices-single choices-single-items">
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                        <optgroup label="Pacific Time Zone">
                                            <option value="CA">California</option>
                                            <option value="NV">Nevada</option>
                                            <option value="OR">Oregon</option>
                                            <option value="WA">Washington</option>
                                        </optgroup>
                                        <optgroup label="Mountain Time Zone">
                                            <option value="AZ">Arizona</option>
                                            <option value="CO">Colorado</option>
                                            <option value="ID">Idaho</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="UT">Utah</option>
                                            <option value="WY">Wyoming</option>
                                        </optgroup>
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TX">Texas</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="WI">Wisconsin</option>
                                        </optgroup>
                                        <optgroup label="Eastern Time Zone">
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="IN">Indiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="OH">Ohio</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WV">West Virginia</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-2">
                                    <label class="form-label" for="add-item">Quantity</label>
                                    <input  name="quantity" type="number" class="form-control ">
                                </div>
                                <div class="mb-3 col-md-2">
                                    <label class="form-label" for="add-item">Action</label>
                                    <div>
                                        <button v-on:click="addItem()" class="btn btn-primary w-100" id="add-item">Add Item</button>
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
                                        <td>@{{item.item_code}}</td>
                                        <td>@{{item.item_name}}</td>
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
                proforma: [],
            }
        }, 

        methods: {
            addItem(){
                this.proforma.push({
                    item_code: 1, item_name: 'sample item', quantity: 20, 
                    tax: 10, selling_price: 20000
                });

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
