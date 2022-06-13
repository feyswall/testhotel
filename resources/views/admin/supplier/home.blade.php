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
                                            <td>{{ $supplier->tin }}</td>
                                            <td>{{ $supplier->vrn }}</td>
                                            <td>{{ $supplier->address }}</td>
                                            <td>{{ $supplier->details }}</td>
                                            <td class="table-action">
                                                <a style="display: inline-block"
                                                    href="{{ route('admin.supplier.edit', $supplier->id) }}"><i
                                                        class="align-middle" data-feather="edit-2"></i></a>
                                                <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Category Name</th>
                                        <th>TotalRecords</th>
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
