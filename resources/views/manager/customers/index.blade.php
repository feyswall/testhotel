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
                                <th>Company</th>
                                <th>ZRB Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->company }}</td>
                                    <td>{{ $customer->zrb }}</td>
                                    <td>
                                        <a href="/customers/{{ $customer->id }}"
                                            class="btn btn-primary btn-block">View</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sn</th>
                                <th>Customer names</th>
                                <th>Email address</th>
                                <th>Contact phone</th>
                                <th>Company</th>
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
