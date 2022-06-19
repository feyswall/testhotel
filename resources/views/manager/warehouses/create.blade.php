@extends('pageLayouts.admin')

@section('title')
    <title>Inventory | Warehouses</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="/customers" class="btn btn-primary float-end mt-n1">All Warehouse</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Create Warehouse</h1>
            </div>


            <div class="card">
                <div class="card-body">
                            <form method="POST" action="/customers/store">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="name">Names</label>
                                    <input value="" name="name" type="text" class="form-control"
                                        id="name" placeholder="Customer names" required>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="location">Location</label>
                                    <input value="" type="location" name="location" class="form-control"
                                        required id="location" placeholder="location">
                                    @error('location')
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
