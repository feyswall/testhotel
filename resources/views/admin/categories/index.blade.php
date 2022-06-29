@php
    $type_name = "";
    switch($type){
        case 1: $type_name = "Items"; break;
        case 2: $type_name = "Expenses"; break;
        case 3: $type_name = "Contracts"; break;
    }
@endphp
@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | {{$type_name}} Categories</title>
@endsection

@section('content')
<main class="content p-4">
    <div class="container-fluid p-0">

        @include('admin._partials._success_and_errors')

        @if ($errors->any())
            <h3 class="lead text-danger">{{ $errors->first() }}</h3>
        @endif

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{$type_name}} Categories</h1>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Available Categories</h5>
                    </div>
                    <table class="table table-borderless my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Total {{$type_name}} Recorded</th>
                                <th class="d-none d-xl-table-cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                           <tr>
                            <td>#</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->desc}}</td>
                            <td>0</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-category-{{$item->id}}" class="btn btn-light">Edit</a>
                                <div class="modal fade" id="edit-category-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body m-3">

                                              <form method="POST" action="/category/edit/{{$item->id}}" id="edit-category-form-{{$item->id}}">
                                                @csrf
                                                @method('PUT')
                                                <div class="row mt-3">
                                                    <div class="col col-md-12">
                                                        <input name="name" value="{{$item->name}}" required type="text" placeholder="Category name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col col-md-12">
                                                        <input name="desc" value="{{$item->desc}}" required type="text" placeholder="Description" class="form-control">
                                                    </div>
                                                </div>
                                              </form>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button form="edit-category-form-{{$item->id}}" type="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                           </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Add Category</h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                           <form action="/save_category" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="{{$type}}">
                                <div class="row mt-3">
                                    <div class="col col-md-12">
                                        <input name="name" required type="text" placeholder="Category name" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col col-md-12">
                                        <input name="desc" required type="text" placeholder="Description" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col col-md-12">
                                        <button type="submit" class="btn w-100 btn-success">Save Category</button>
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
