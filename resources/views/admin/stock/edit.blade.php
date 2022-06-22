@extends('pageLayouts.admin')

@section('title')
    <title>Records | stock</title>
@endsection

@section('content')
    <main class="content p-4" id="app">
        <div class="container-fluid p-0">

                <a class="btn btn-primary float-end mt-n1 mx-3" href="{{ route('admin.stock.index') }}">All stocks</a>
                <a class="btn btn-success float-end mt-n1" data-bs-toggle="modal" data-bs-target="#new-stock" href="#">Edit Record</a>


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
                                                            <input required type="name" class="form-control" name="name" placeholder="Stock name" value="{{ $stock->name }}">
                                                            @error('name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="location">Location</label>
                                                            <input required type="text" name="location" id="location" placeholder="Stock Location"  class="form-control" value="{{ $stock->location }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="desc">Description</label>
                                                            <textarea class="form-control" id="desc" name="desc" required  placeholder="Description" rows="3">{{  $stock->desc }}</textarea>
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
                <h1 class="h3 d-inline align-middle font-weight-bold">Stock Records</h1>
            </div>


                    @include('admin._partials._success_and_errors')


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p>STOCK NAME:  {{ $stock->name }}</p>
                            <P>STOCK LOCATION:  {{ $stock->location }}</P>
                            <p>STOCK DESCRIPTION: {{ $stock->desc }}</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                              <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom pb-0">
                            <div class="row justify-content-between">
                                <div class="col col-md-6">
                                    <input v-model="item_search" type="text" placeholder="Find specific item" class="form-control">
                                    <button v-on:click='search'>search</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item</th>
                                                <th>Description</th>
                                            <th>Selling Price</th>
                                            <th>Gross Price</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)                                        
                                            <tr>
                                                {{-- <td>
                                                    <img src="{{ asset('assets/img/avatars/avatar-5.jpg') }}" width="35" height="35" class="rounded m-0" alt="image">
                                                </td> --}}
                                                
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->code }}</td>
                                                <td>
                                                    <form id="form-{{ $item->id }}" action="">
                                                        <input type="text" name="quantiy">
                                                    </form>
                                                </td>
                                                <td>{{ number_format($item->selling_price, 2) }}</td>
                                                <td>{{ number_format($item->gross_price, 2) }}</td>
                                                <td class="table-action">
                                                    <button form="form-{{ $item->id }}" class="btn btn-sm btn-outline-secondary">add</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="col col-md-5">{{ $items->links() }}</div>
                        
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

            data(){
                return {
                    item_search: '', 
                    results: [],
                }
            },

            methods: {
                search() {
                this.searching = true;

                  const requestOptions = {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ term:this.item_search, _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content') })
                    };

                fetch('/items/in/search', requestOptions)
                    .then(res => res.json())
                    .then(res => {
                        console.log( res )
                        this.results = res;
                    });
                },

                
            }
        });
    </script>

@endsection