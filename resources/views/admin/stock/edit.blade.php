@extends('pageLayouts.admin')
@section('title')
<title>Records | stock</title>
@endsection
@section('content')
<main class="content p-4" id="app">
   <div class="container-fluid p-0">
      <a class="btn btn-primary float-end mt-n1 mx-3" href="{{ route('admin.stock.index') }}">All stocks</a>
      <a class="btn btn-success float-end mt-n1" data-bs-toggle="modal" data-bs-target="#new-stock" href="#">Edit
      Record</a>
      <div class="modal fade" id="new-stock" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Update stock<span class="font-weight-bold"></span></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body m-3">
                  @error('cash_mode')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <h3 class="lead">Update "{{ $stock->name }}" Stock</h3>
                  <form id="add-stock" action="{{ route('admin.stock.update', $stock->id) }}" method="post">
                     @csrf
                     @method('put')
                     <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input required type="name" class="form-control" name="name"
                           placeholder="Stock name" value="{{ $stock->name }}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label class="form-label" for="location">Location</label>
                        <input required type="text" name="location" id="location"
                           placeholder="Stock Location" class="form-control" value="{{ $stock->location }}">
                     </div>
                     <div class="mb-3">
                        <label class="form-label" for="desc">Description</label>
                        <textarea class="form-control" id="desc" name="desc" required placeholder="Description" rows="3">{{ $stock->desc }}</textarea>
                     </div>
                  </form>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button form="add-stock" type="submit" class="btn btn-success">save stock</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end model -->
      <div class="mb-3">
         <h1 class="h3 d-inline align-middle font-weight-bold">Stock Items</h1>
      </div>
      @include('admin._partials._success_and_errors')
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <p>STOCK NAME: {{ $stock->name }}</p>
                  <P>STOCK LOCATION: {{ $stock->location }}</P>
                  <p>STOCK DESCRIPTION: {{ $stock->desc }}</p>
               </div>
            </div>
    

                        <div class="col-12 col-lg-12">
							<div class="tab tab-vertical">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#vertical-icon-tab-1" data-bs-toggle="tab" role="tab">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home align-middle"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#vertical-icon-tab-2" data-bs-toggle="tab" role="tab">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings align-middle"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#vertical-icon-tab-3" data-bs-toggle="tab" role="tab">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square align-middle"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="vertical-icon-tab-1" role="tabpanel">
										<h4 class="tab-title">Vertical icon tabs</h4>
                                                                <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Item</th>
                                 <th>Description</th>
                                 <th>Selling Price</th>
                                 <th>Gross Price</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($stock->items as $item)                                        
                              <tr>
                                 {{-- 
                                 <td>
                                    <img src="{{ asset('assets/img/avatars/avatar-5.jpg') }}" width="35" height="35" class="rounded m-0" alt="image">
                                 </td>
                                 --}}
                                 <td>{{ $item->id }}</td>
                                 <td>{{ $item->code }}</td>
                                 <td>{{ $item->desc }}</td>
                                 <td>{{ number_format($item->selling_price, 2) }}</td>
                                 <td>{{ number_format($item->gross_price, 2) }}</td>
                              </tr>
                              @endforeach
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th>#</th>
                                 <th>Item</th>
                                 <th>Description</th>
                                 <th>Selling Price</th>
                                 <th>Gross Price</th>
                              </tr>
                           </tfoot>
                        </table>
									</div>
									<div class="tab-pane" id="vertical-icon-tab-2" role="tabpanel">
										<h4 class="tab-title">Another one</h4>
										 <div class="col-12">
                           <div class="card">
                              <div class="card-header border-bottom pb-2">
                                 <div class="card-actions float-end">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <meta name="stock_id" content="{{ $stock->id }}">
                                    <button :disabled="items.length == 0" v-on:click="saveItems()"
                                       class="btn btn-success float-end text-white">Save Items</button>
                                 </div>
                                 <div class="card-actions float-end mx-3">
                                    <div class="row">
                                       <div class="col col-md-12">
                                          <input v-model="item_search" @keyup.enter="search()" type="text"
                                             class="form-control" placeholder="Search items">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card-actions float-end">
                                    <a href="#" v-if="results.length > 0"  v-on:click="closeTable()" class="btn btn-danger text-white float-end">
                                    <i class="la la-close"></i>
                                    </a>
                                 </div>
                                 <h5 class="card-title">Stock Items</h5>
                                 <h6 class="card-subtitle text-muted">Pick stock items</h6>
                              </div>
                              <div class="card-body">
                                 <div class="mx-3">
                                    @if ($errors->any())
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                    @endif
                                 </div>
                                 <table v-if="(results.length == 0 && items.length == 0)" class="table table-striped"
                                    style="width:100%">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Item</th>
                                          <th>Description</th>
                                          <th>Selling Price</th>
                                          <th>Gross Price</th>
                                          <th>Sale Price</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ([1, 2] as $item)
                                       <tr>
                                          <td></td>
                                          <td>existing</td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td class="table-action">
                                          </td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                                 <table v-if="results.length != 0" class="table table-striped" style="width:100%">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Item</th>
                                          <th>Description</th>
                                          <th>Selling Price</th>
                                          <th>Quantity</th>
                                          <th>Sale Price</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr v-for="(item, index) in results" :key="'item' + index">
                                          <td>@{{ index + 1 }}</td>
                                          <td>@{{ item.code }}</td>
                                          <td>@{{ item.desc }}</td>
                                          <td>@{{ item.selling_price }}</td>
                                          <td><input type="number" min="0" v-model="item.quantity"
                                             class="form-control" placeholder="Quantity"></td>
                                          <td><input type="number" min="0" v-model="item.sale_price"
                                             class="form-control" placeholder="Sale price"></td>
                                          <td><button v-on:click="selectItem(index)" class="btn btn-primary"><i
                                             class="la la-plus"></i></button></td>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <hr v-if="items.length != 0">
                                 <table v-if="items.length != 0" class="table table-striped" style="width:100%">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Item</th>
                                          <th>Description</th>
                                          <th>Selling Price</th>
                                          <th>Quantity</th>
                                          <th>Sale Price</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr v-for="(item, index) in items" :key="'selected_item' + index">
                                          <td>@{{ index + 1 }}</td>
                                          <td>@{{ item.code }}</td>
                                          <td>@{{ item.desc }}</td>
                                          <td>@{{ item.selling_price }}</td>
                                          <td>@{{ item.quantity }}</td>
                                          <td>@{{ item.sale_price }}</td>
                                          <td><button v-on:click="removeItem(index)" class="btn btn-danger"><i
                                             class="la la-trash"></i></button></td>
                                       </tr>
                                    </tbody>
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
</div>
</main>
@endsection
@section('ourScript')
<script>
   var app = new Vue({
       el: "#app",
   
       data() {
           return {
               results: [],
               items: [],
               item_search: "",
               searching: false
           }
       },
   
       methods: {
           closeTable(){
               this.results = [];
           }, 
   
           async search() {
               if (this.item_search == "") {
                   this.results = [];
               } else {
                   this.searching = true;
                   fetch(`/items/search/${encodeURIComponent(this.item_search)}`)
                       .then(res => res.json())
                       .then(res => {
                           this.results = res;
                       });
               }
           },
   
           async saveItems() {
               if (this.items.length > 0) {
                   var list = [];
                   var stock_id = $('meta[name="stock_id"]').attr('content');
                   for (var i = 0; i < this.items.length; i++) {
                       list.push({
                           'item_id': this.items[i].id,
                           'item_quantity': this.items[i].quantity,
                           'due_price': this.items[i].selling_price,
                       });
                   }
   
                   var requestOptions = {
                       method: "PUT",
                       headers: {
                           "Content-Type": "application/json",
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                       body: JSON.stringify({list})
                   };
                   var response = await fetch(`/stocks/add/items/${stock_id}`, requestOptions);
                   var data = await response.json();
                   // window.location.reload();
               }
           },
   
           itemAvailable(index) {
               var selected = this.results[index];
               var target = this.items.find(item => item.id == selected.id);
               return target != null;
           },
   
           selectItem(index) {
               var exists = this.itemAvailable(index);
               if (exists) {
                   alert("Item already added!");
               } else {
                   var item = this.results[index];
                   if (item.quantity == undefined || item.sale_price == undefined) {
                       alert("Fill the inputs!");
                   } else {
                       this.items.push(item);
                       this.results.splice(index, 1);
                   }
               }
           },
   
           removeItem(index) {
               this.items.splice(index, 1);
           },
       },
   });
</script>
@endsection