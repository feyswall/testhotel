@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Suppliers</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            @include('admin._partials._success_and_errors')

            <a href="{{ route('contracts.index') }}" class="btn btn-primary float-end mt-n1">All Contracts</a>

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> New Contract</h1>
            </div>


            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('contract.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                    id="name" placeholder="">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="desc">Description</label>
                                <input type="text" value="{{ old('desc') }}" name="desc" class="form-control"
                                    id="desc" placeholder="">
                                @error('desc')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="party">Party</label>
                                <input type="text" value="{{ old('party') }}" name="party" class="form-control"
                                    id="party" placeholder="">
                                @error('party')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="category->id">Category</label>
                                <Select name="category_id" value="{{ old('category->id') }}" class="form-select" id="category->id"
                                    placeholder="">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </Select>
                                @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="start_date">Start Date</label>
                                <input type="date" value="{{ old('start_date') }}" name="start_date"
                                    class="form-control" id="start_date" placeholder="">
                                @error('start_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="end_date">End Date</label>
                                <input value="{{ old('end_date') }}" type="date" name="end_date" class="form-control"
                                    id="end_date" placeholder="">
                                @error('end_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-md-12 mb-3">
                                <label class="form-label">PDF</label>
                                <input type="file" class="form-file" name="file" />
                                @error('file')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="reset" class="btn btn-secondary">Reset Form</button>
                        <button type="submit" class="btn btn-primary">Save Contract</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
