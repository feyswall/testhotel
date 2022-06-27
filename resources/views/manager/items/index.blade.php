@extends('pageLayouts.admin')

@section('title')
    <title>Inventory | Items</title>
@endsection

@section('content')
    <main class="content p-4" id="app">
        <div class="container-fluid p-0">

             @if ( $errors->any() )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                       {{ $errors->first() }}
                    </div>
                </div>
            @endif

            @include('admin._partials._success_and_errors')


             @if ( session()->has('excelSuccess') )
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>OK!  </strong>  {{ session()->get('excelSuccess') }}
                    </div>
                </div>
            @endif

            <a href="/items/create" class="btn btn-primary float-end mt-n1 mx-3">Add Item</a>
            <form action="/items/import" method="post" enctype="multipart/form-data">
                @csrf
                <button class="btn btn-success float-end mt-n1" type="submit">Upload Excel</button>
                <a href="#" class="float-end mt-n1">
                    <input type="file" name="excel" id="itemExcel" class="form-control rounded-none">
                </a>
            </form>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Lastly Added Items</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom pb-2">
                            <div class="row justify-content-between">
                                <div class="col col-md-6">
                                    <input v-model="item_search" type="text" placeholder="Find specific item" class="form-control">
                                </div>
                            </div>
                        </div>
                       
                        
                        <div class="card-body">
                            <table id="" class="table table-striped" style="width:100%">
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
                                <tbody v-if="item_search == ''">
                                    @foreach ($items as $item)                                        
                                    <tr>
                                        {{-- <td>
                                            <img src="{{ asset('assets/img/avatars/avatar-5.jpg') }}" width="35" height="35" class="rounded m-0" alt="image">
                                        </td> --}}
                                        
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->desc }}</td>
                                        <td>{{ number_format($item->selling_price, 2) }}</td>
                                        <td>{{ number_format($item->gross_price, 2) }}</td>
                                        <td class="table-action">
                                            <a href="{{ route('admin.items.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">Open</a>
                                            {{-- <form id="delete-item" method="POST" action="{{ route('admin.items.delete', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button class="btn btn-light" form="delete-item" type="submit"><i class="align-middle la la-trash text-danger"></i></button> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tbody v-if="item_search != ''">
                                    <tr v-for="(item, index) in results" :key="'item' + item.id">
                                        <td>@{{ item.id }}</td>
                                        <td>@{{ item.code }}</td>
                                        <td>@{{ item.desc }}</td>
                                        <td>@{{ item.selling_price }}</td>
                                        <td>@{{ item.gross_price }}</td>
                                        <td><a :href="'/items/edit/' + item.id" class="btn btn-sm btn-outline-secondary">Open</a></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                         <th>#</th>
                                         <th>Item</th>
                                         <th>Description</th>
                                        <th>Selling Price</th>
                                        <th>Gross Price</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                                <div class="col col-md-5">{{ $items->links() }}</div>


        </div>
    </main>

    <script>
        var app = new Vue({
            el: "#app", 

            data(){
                return {
                    item_search: '', 
                    searching: false, 
                    results: [],
                    noResults: true
                }
            },

            watch: {
                item_search(c, o){
                    if(c.length == 0){
                        this.results = [];
                        this.noResults = true;
                        this.item_search = '';
                    }
                    if(c.length == 0){
                        window.location.reload();
                    }else{
                        this.search();
                    }
                }
            },

            methods: {
                search() {
                    this.searching = true;

                    var requestOptions = {
                        method: "post",
                        headers: { 
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                         body: JSON.stringify({ item:this.item_search })
                    };

                    fetch('all/items/search', requestOptions)
                        .then(res => res.json())
                        .then(res => {
                            this.searching = false;
                            this.results = res;
                            this.noResults = this.results.length === 0;
                    });
                }
            }
            
        });
    </script>
@endsection
