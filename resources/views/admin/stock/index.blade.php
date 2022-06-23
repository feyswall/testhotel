@extends('pageLayouts.admin')

@section('title')
    <title>Records | stock</title>
@endsection

@section('content')
    <main class="content p-4" id="app">
        <div class="container-fluid p-0">

                <a class="btn btn-primary float-end mt-n1" data-bs-toggle="modal" data-bs-target="#new-stock" href="#">New Record</a>

                              <div class="modal fade" id="new-stock" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add new stock <span class="font-weight-bold"></span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body m-3">
                                                    @error('cash_mode')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror

                                                    <form id="add-stock" action="{{ route('admin.stock.store') }}" method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Name</label>
                                                            <input required type="name" class="form-control" name="name" placeholder="Stock name" value="{{ old('name') }}">
                                                            @error('name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="location">Location</label>
                                                            <input required type="text" name="location" id="location" placeholder="Stock Location"  class="form-control" value="{{ old('location') }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="desc">Description</label>
                                                            <textarea class="form-control" id="desc" name="desc" required  placeholder="Description" rows="3">{{ old('desc') }}</textarea>
                                                        </div>
                                        
                                                    </form>


                                                  <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button form="add-stock" type="submit" class="btn btn-success">save stock</button>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
<!-- end model -->



            <div class="mb-3">
                <h1 class="h3 d-inline align-middle font-weight-bold">Stocks</h1>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-buttons" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $stocks as $stock )
                                    <tr>
                                        <td>{{ $stock->id }}</td>
                                        <td>{{ $stock->name }}</td>
                                        <td>{{ $stock->location }}</td>
                                        <td>
                                            <a href="{{ route('admin.stock.edit', $stock->id) }}" class="btn btn-outline-primary">View Items</a>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </main>
@endsection
