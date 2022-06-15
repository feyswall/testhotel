{{-- @extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Customers</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="/customers" class="btn btn-primary float-end mt-n1"><i class="fa fa-arrow-left"></i> View Customers</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> New Customer</h1>
            </div>


                <div class="card">
                    <div class="card-body">

                </div>
            </div>

        </div>
    </main>
@endsection --}}





@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Customers</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="/customers" class="btn btn-primary float-end mt-n1"><i class="fa fa-arrow-left"></i> View Customers</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> New Customer</h1>
            </div>


            <div class="card">
                <div class="card-body">
                            <form method="POST" action="/customers/store">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="inputEmail4">Names</label>
                                    <input value="{{ old('name') }}" name="name" type="text" class="form-control"
                                        id="inputEmail4" placeholder="Customer names" required>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="inputEmail4">Phone</label>
                                    <input value="{{ old('phone') }}" type="phone" name="phone" class="form-control"
                                        required id="inputEmail4" placeholder="Contact phone">
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="inputEmail4">Email</label>
                                    <input value="{{ old('email') }}" type="email" name="email" class="form-control"
                                        id="inputEmail4" placeholder="Email" required>
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="inputEmail4">ZRB</label>
                                    <input value="{{ old('zrb') }}" type="text" name="zrb" class="form-control"
                                        id="inputEmail4" placeholder="ZRB number" required>
                                    @error('zrb')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="inputEmail4">Address</label>
                                    <input value="{{ old('address') }}" type="text" name="address" class="form-control"
                                        id="inputEmail4" placeholder="Location address" required>
                                    @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="inputEmail4">Company</label>
                                    <input name="company" value="{{ old('company') }}" type="text" class="form-control"
                                        id="inputEmail4" placeholder="Company or organization" required>
                                @error('company')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                    </div>
                            </div>

                        <button type="reset" class="btn btn-secondary">Reset Form</button>
                        <button type="submit" class="btn btn-primary">Save Customer</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection