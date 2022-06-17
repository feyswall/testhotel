@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Payment Methods</title>
@endsection

@section('content')
   
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Payment Methods</h1>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Available Payment Methods</h5>
                        </div>
                        <table class="table table-borderless my-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th class="d-none d-xl-table-cell">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($methods as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="bg-light rounded-2">
                                                    <i class="la la-wallet h2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="d-none d-xxl-table-cell">
                                        <strong>{{$item->name}}</strong>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <a class="badge bg-success ms-2">Active</a>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit-method-{{$item->id}}" class="btn btn-light">Edit</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit-method-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Payment Method</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body m-3">

                                              <form method="POST" action="/methods/edit/{{$item->id}}" id="edit-method-form">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col col-md-12">
                                                        <input name="name" value="{{$item->name}}" type="text" placeholder="Method name" class="form-control">
                                                    </div>
                                                </div>
                                              </form>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button form="edit-method-form" type="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Add Payment Method</h5>
                        </div>
                        <div class="card-body d-flex w-100">
                            <div class="align-self-center chart chart-lg">
                               <form action="/save_method" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col col-md-12">
                                            <input name="name" type="text" placeholder="Method name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col col-md-12">
                                            <button type="submit" class="btn w-100 btn-success">Save Payment Method</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
