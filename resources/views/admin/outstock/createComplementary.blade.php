
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
                    <form method="POST" action="{{ route('admin.items.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="selling_price">From Stock</label>
                                <select v-on:change="fillItems" v-model="stock_id" name="stock_id" class="form-select" required id="stock_id">
                                    @foreach (App\Models\Stock::all() as $stock)
                                        <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                    @endforeach
                                </select>
                                @error('stock_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                        </div>
                    </form>
                    <div class="row" v-if="items.length > 0">
                        <div class="col col-md-12">
                            <table class="table" id="datatables-column-search-text-inputs">
                                <thead>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in items" :key="'item' + index">
                                        <td>@{{index + 1}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
        const app = new Vue({
            el: "#app",
            data(){
                return {
                    items: [],
                    stock_id: '',
                }
            },
            methods: {
                fillItems(){
                    var requestOptionsSearch = {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify({ stock_id: this.stock_id })
                    };
                    fetch('/stock/items/search', requestOptionsSearch )
                    .then(res => res.json())
                    .then(res => {
                        this.items = res;
                    });
                }
            },
        });
    </script>
@endsection
