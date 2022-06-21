@extends('pageLayouts.admin')

@section('title')
    <title>Inventory | Items</title>
@endsection

@section('content')
     <main class="content p-4">
        <div class="container-fluid p-0">
            <a href="/items" class="btn btn-primary float-end mt-n1">View Items</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Edit Item</h1>
            </div>


            <div class="card">
                <div class="card-body">
                            <form method="POST" action="{{ route('admin.items.update', $item->id) }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                {{-- <div class="mb-3 col-md-4">
                                    <label class="form-label" for="name">Names</label>
                                    <input value="{{ old('name') }}" name="name" type="text" class="form-control"
                                        id="name" placeholder="Customer names" required>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div> --}}
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="selling_price">Selling Price</label>
                                    <input value="{{ $item->selling_price }}" type="text" name="selling_price" class="form-control"
                                        required id="selling_price" placeholder="Contact selling_price">
                                    @error('selling_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="code">Code</label>
                                    <input value="{{ $item->code }}" type="text" name="code" class="form-control"
                                        id="code" placeholder="code" required>
                                    @error('code')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="desc">Description</label>
                                    <textarea value="{{ $item->desc }}" rows="3" type="text" name="desc" class="form-control"
                                        id="desc" required>{{  $item->desc }}</textarea>
                                    @error('desc')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="pref_supplier">Prefered Supplier</label>
                                    <input value="{{ $item->pref_supplier }}" type="text" name="pref_supplier" class="form-control"
                                        id="pref_supplier" placeholder="Location pref_supplier">
                                    @error('pref_supplier')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="gross_price">Gross Price</label>
                                    <input name="gross_price" value="{{ $item->gross_price }}" type="text" class="form-control"
                                        id="gross_price" placeholder="gross_price or organization" required>
                                @error('gross_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                    </div>
                            </div>

                        <button type="reset" class="btn btn-secondary">Reset Form</button>
                        <button type="submit" class="btn btn-success">Save Item</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
