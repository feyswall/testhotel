@extends('pageLayouts.admin')


@section('title')
    <title>Backoffice | Customers</title>
@endsection

@section('content')
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">
                <a href="#" class="btn btn-primary float-end mt-n1">New Customer</a>
                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle"> Customers</h1>
                </div>


                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-actions float-end">
                            <div class="dropdown show">
                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                    <i class="align-middle" data-feather="more-horizontal"></i>
                                </a>
    
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Clients</h5>
                    </div>
                    <div class="card-body">

                        <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/avatar-5.jpg') }}" width="35" height="35" class="rounded m-0" alt="image">
                                    </td>
                                    <td>System Architect</td>
                                    <td>35</td>
                                    <td class="table-action">
                                        <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                        <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/avatar-5.jpg') }}" width="35" height="35" class="rounded m-0" alt="image">
                                    </td>
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
                                    <th>Thumbnail</th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>


                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection