@extends('pageLayouts.admin')

@section('title')
    <title>Inventory | Items</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

             @if ( $errors->any() )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                       {{ $errors->first() }}
                    </div>
                </div>
            @endif

            @include('admin._partials._success_and_errors')


             @if ( session()->has('excelSuccess') )
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>Hi!  </strong>  {{ session()->get('excelSuccess') }}
                    </div>
                </div>
            @endif

            <form action="/items/import" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="form-label" for="itemExcel">Enter your file</label>
                    <input type="file" name="excel" id="itemExcel">
                </div>
                <button class="btn btn-primary" type="submit">submit</button>
            </form>


            <a href="/items/create" class="btn btn-primary float-end mt-n1">Add Item</a>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Items</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Description</th>
                                       <th>Selling Price</th>
                                       <th>Gross Price</th>
                                       <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($items as $item)                                        
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/img/avatars/avatar-5.jpg') }}" width="35" height="35" class="rounded m-0" alt="image">
                                        </td>
                                        
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->desc }}</td>
                                        <td>{{ number_format($item->selling_price, 2) }}</td>
                                        <td>{{ number_format($item->gross_price, 2) }}</td>
                                        <td class="table-action">
                                            <a href="{{ route('admin.items.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">Open</a>
                                            {{-- <form id="delete-item" method="POST" action="{{ route('admin.items.delete', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button class="btn btn-light" form="delete-item" type="submit"><i class="align-middle la la-trash text-danger"></i></button> --}}
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                         <th>#</th>
                                         <th>Item</th>
                                         <th>Description</th>
                                        <th>Selling Price</th>
                                        <th>Gross Price</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    {{ $items->links() }}
                </div>
            </div>

        </div>
    </main>
@endsection
