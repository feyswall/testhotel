@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Customers</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="/customers" class="btn btn-primary float-end mt-n1"><i class="fa fa-arrow-left"></i> View Customers</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Edit Customer</h1>
            </div>


            <div class="card">
                <div class="card-body">
                    <form method="PUT" action="/customers/update">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputEmail4">Names</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Customer names">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputEmail4">Phone</label>
                                <input type="phone" class="form-control" id="inputEmail4" placeholder="Contact phone">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Email address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputEmail4">ZRB</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="ZRB number">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputEmail4">Address</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Location address">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputEmail4">Company</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Company or organization">
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
