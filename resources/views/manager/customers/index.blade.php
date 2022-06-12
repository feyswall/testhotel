@extends('pageLayouts.admin')


@section('title')
    <title>Backoffice | Customers</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="/customers/create" class="btn btn-primary float-end mt-n1">New Customer</a>
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
                                <th>Sn</th>
                                <th>Customer names</th>
                                <th>Email address</th>
                                <th>Contact phone</th>
                                <th>ZRB Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Changu Wanazi</td>
                                <td>changuwanazi@gmail.com</td>
                                <td>0 717 561 007</td>
                                <td>120-1551-9090</td>
                                <td>
                                    <a href="/customers/1" class="btn btn-primary btn-block">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mteja Mbili</td>
                                <td>omilaborta@gmail.com</td>
                                <td>0 717 561 007</td>
                                <td>120-1551-9090</td>
                                <td>
                                    <a href="/customers/1" class="btn btn-primary btn-block">View</a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sn</th>
                                <th>Customer names</th>
                                <th>Email address</th>
                                <th>Contact phone</th>
                                <th>ZRB Number</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>


                </div>
            </div>
        </div>
    </main>
@endsection