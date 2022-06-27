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
                                    <select v-on:change="fillItems" name="stock_id" class="form-select"
                                        required id="stock_id">
                                        @foreach (App\Models\Stock::all() as $stock)
                                            <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('stock_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="items">Items</label>
                                    <select name="items" class="form-select" required>
                                        <option v-for="(item, key) in items" :value="item.id" >@{{ item.name }}</option>
                                    </select>
                                    @error('items')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        

                        <button type="reset" class="btn btn-secondary">Reset Form</button>
                        <button type="submit" class="btn btn-primary">Save Item</button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    {{-- @section('ourScript') --}}
        <script>
            const app = new Vue({
                el: "#app",
                data(){
                    return {
                        items: [
                            {name: 'first', id: 1},
                            {name: 'second', id: 2 }
                        ],
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
                            this.searching = false;
                            this.results = res;
                            this.noResults = this.results.length === 0;
                        });

                    }
                },
            });
        </script>
    {{-- @endsection --}}
@endsection
