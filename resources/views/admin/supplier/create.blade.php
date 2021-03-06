@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Suppliers</title>
@endsection

@section('content')
    <main class="content p-4">
        <div class="container-fluid p-0">
            <a href="/suppliers" class="btn btn-primary float-end mt-n1">View Suppliers</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> New Supplier</h1>
            </div>


            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.supplier.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="name">Names</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name"
                                    placeholder="" required>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="phone" value="{{ old('phone') }}" name="phone" class="form-control"
                                    id="phone" placeholder="" required>
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                                    id="email" placeholder="" >
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="tin">TIN</label>
                                <input name="tin" type="text" value="{{ old('tin') }}" class="form-control" id="tin"
                                    placeholder="" required>
                                @error('tin')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="vrn">VRN</label>
                                <input type="text" value="{{ old('vrn') }}" name="vrn" class="form-control" id="vrn"
                                    placeholder="" required>
                                @error('vrn')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="address">Address</label>
                                <input value="{{ old('address') }}" type="text" name="address" class="form-control"
                                    id="address" placeholder="" required>
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-md-12 mb-3">
                                <label class="form-label">Supplier details</label>
                                <textarea class="form-control" value="{{ old('details') }}" name="details" placeholder="" rows="1"></textarea>
                                @error('details')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="reset" class="btn btn-secondary">Reset Form</button>
                        <button type="submit" class="btn btn-primary">Save Supplier</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
