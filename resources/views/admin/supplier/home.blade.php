@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Suppliers</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="/suppliers/create" class="btn btn-primary float-end mt-n1">Add Supplier</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Suppliers</h1>
            </div>

            @include('admin._partials._success_and_errors')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Supplier No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>TIN</th>
                                        <th>VRN</th>
                                        <th>Address</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $supplier)
                                        <tr>
                                            <td>{{ $supplier->id }}</td>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->email ? $supplier->email : 'empty' }}</td>
                                            <td>{{ $supplier->phone ?? 'empty' }}</td>
                                            <td>{{ $supplier->tin }}</td>
                                            <td>{{ $supplier->vrn }}</td>
                                            <td>{{ $supplier->address }}</td>
                                            <td>{{ $supplier->details }}</td>
                                            <td>
                                                <a href="{{ route('admin.supplier.edit', $supplier->id) }}"
                                                    class="btn btn-primary btn-block">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>supplier id</th>
                                        <th>Supplier Name</th>
                                        <th>Emain</th>
                                        <th>phone</th>
                                        <th>TIN</th>
                                        <th>VRN</th>
                                        <th>Address</th>
                                        <th>Details</th>
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
@endsection
