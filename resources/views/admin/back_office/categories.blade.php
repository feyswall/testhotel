@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Categories</title>
@endsection

@section('content')
    @php
    $type_name = "";
    switch($type){
        case 1: $type_name = "Items"; break;
        case 2: $type_name = "Expenses"; break;
        case 3: $type_name = "Contracts"; break;
        default: 
        $type_name = "Items";
    }
    @endphp
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">

                <a href="#" class="btn btn-primary float-end mt-n1">Add Category</a>
                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">{{ $type_name }} Categories</h1>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Serial No</th>
                                            <th>Category Name</th>
                                            <th>Total {{$type_name}} Records</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#</td>
                                            <td>System Architect</td>
                                            <td>35</td>
                                            <td class="table-action">
												<a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
												<a href="#"><i class="align-middle" data-feather="trash"></i></a>
											</td>
                                        </tr>
                                        <tr>
                                            <td>#</td>
                                            <td>Customer Support</td>
                                            <td>20</td>
                                            <td class="table-action">
												<a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
												<a href="#"><i class="align-middle" data-feather="trash"></i></a>
											</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Serial No</th>
                                            <th>Category Name</th>
                                            <th>Total {{$type_name}} Records</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
@endsection
