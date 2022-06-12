@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Suppliers</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="/suppliers" class="btn btn-primary float-end mt-n1"><i class="fa fa-arrow-left"></i> View Suppliers</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> New Suppliers</h1>
            </div>


            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/suppliers/store">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputEmail4">Names</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Supplier names">
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
                                <label class="form-label" for="inputEmail4">TIN</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="TIN number">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputEmail4">VRN</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="VRN number">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputEmail4">Address</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Location address">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-md-12 mb-3">
                                <label class="form-label">Supper details</label>
                                <textarea class="form-control" placeholder="Textarea" rows="1"></textarea>
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
