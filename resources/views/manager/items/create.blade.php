@extends('pageLayouts.admin')

@section('title')
    <title>Inventory | Items</title>
@endsection

@section('content')
     <main class="content p-4">
        <div class="container-fluid p-0">
            <a href="/items" class="btn btn-primary float-end mt-n1">View Items</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> New Item</h1>
            </div>


            <div class="card">
                <div class="card-body">
                            <form method="POST" action="{{ route('admin.items.store') }}">
                            @csrf
                            <div class="row">
              
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="selling_price">Selling Price</label>
                                    <input value="{{ old('selling_price') }}" type="text" name="selling_price" class="form-control"
                                        required id="selling_price" placeholder="selling price">
                                    @error('selling_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="code">Code</label>
                                    <input value="{{ old('code') }}" type="text" name="Item code" class="form-control"
                                        id="code" placeholder="code" required>
                                    @error('code')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="desc">Description</label>
                                    <textarea value="{{ old('desc') }}" rows="3" type="text" name="desc" class="form-control"
                                        id="desc" required>{{  old('desc')}}</textarea>
                                    @error('desc')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="pref_supplier">Supplier</label>
                                    <input value="{{ old('pref_supplier') }}" type="text" name="pref_supplier" class="form-control"
                                        id="pref_supplier" placeholder="Prefered supplier" required>
                                    @error('pref_supplier')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="gross_price">Gross Price</label>
                                    <input name="gross_price" value="{{ old('gross_price') }}" type="text" class="form-control"
                                        id="gross_price" placeholder="Price" required>
                                @error('gross_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                    </div>
                            </div>

                        <button type="reset" class="btn btn-secondary">Reset Form</button>
                        <button type="submit"- class="btn btn-primary">Save Item</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
