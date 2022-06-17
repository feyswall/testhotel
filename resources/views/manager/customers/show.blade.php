@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Customers</title>
@endsection

@section('content')
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">
                <a href="/customers" class="btn btn-primary float-end mt-n1">View Customers</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Edit Customer</h1>
            </div>

               @include('admin._partials._success_and_errors')

                <div class="card">
                    <div class="card-body">

                        <form method="POST" id="formOne" action="{{ route('admin.customer.update', $customer->id) }}">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="name">Names</label>
                                    <input name="name" value="{{ $customer->name }}" type="text" class="form-control"
                                        id="name" placeholder="Customer names">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input name="phone" value="{{ $customer->phone }}" type="phone" class="form-control"
                                        id="phone" placeholder="Contact phone">
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="email">Email</label>
                                    <input name="email" value="{{ $customer->email }}" type="email" class="form-control"
                                        id="email" placeholder="Email">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="zrb">ZRB</label>
                                    <input type="text" name="zrb" value="{{ $customer->zrb }}" class="form-control"
                                        id="zrb" placeholder="ZRB number">
                                    @error('zrb')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="address">Address</label>
                                    <input name="address" value="{{ $customer->address }}" type="text"
                                        class="form-control" id="address" placeholder="Location address">
                                    @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="company">Company</label>
                                    <input name="company" value="{{ $customer->company }}" type="text"
                                        class="form-control" id="company" placeholder="Company or organization">
                                    @error('company')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="tin">TIN</label>
                                    <input type="text" name="tin" value="{{ $customer->tin }}" class="form-control"
                                        id="tin" placeholder="TIN number">
                                    @error('tin')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="vrn">VRN</label>
                                    <input name="vrn" value="{{ $customer->vrn }}" type="text"
                                        class="form-control" id="vrn" placeholder="VRN number">
                                    @error('vrn')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                           
                            </div>
                        </form>
                        <form method="POST" id="formTwo" action="{{ route('admin.customer.destroy', $customer->id) }}">
                            @csrf
                            @method('delete')
                        </form>
                        <button type="button" class="btn btn-danger"
                            onclick=" confirm('are you sure you want to delete?!') ? document.querySelector('#formTwo').submit() : '' ">delete</button>
                        <button type="reset" form="formOne" class="btn btn-secondary">Reset Form</button>
                        <button type="submit" form="formOne" class="btn btn-primary">Save Customer</button>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
