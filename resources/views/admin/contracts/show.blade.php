@extends('pageLayouts.admin')

@section('title')
    <title>Records | Contracts</title>
@endsection

@section('content')
    <main class="content p-4">

         <div class="row justify-content-end">

            <div>
                @include('admin._partials._success_and_errors')
            </div>

                <div class="col-md-4 col-sm-12 mb-2">
                    <a href="{{ route('contract.create') }}" class="btn btn-primary float-end mt-n1">Add Contract</a>
                </div>
            </div>


        <div class="container-fluid p-0 card">

            <div class="m-3">
                <h1 class="h3 d-inline align-middle"> Edit "{{ $contract->name }}" Contract</h1>
            </div>

                        <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('contract.update', $contract->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="name">Names</label>
                                <input type="text" value="{{ $contract->name }}" name="name" class="form-control"
                                    id="name" placeholder="">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="desc">Description</label>
                                <input type="text" value="{{ $contract->desc }}" name="desc" class="form-control"
                                    id="desc" placeholder="">
                                @error('desc')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="party">Party</label>
                                <input type="text" value="{{ $contract->party }}" name="party" class="form-control"
                                    id="party" placeholder="">
                                @error('party')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="category->id">Category</label>
                                <Select name="category_id" value="{{ $contract->category_id }}" class="form-select" id="category->id"
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
                                <input type="date" value="{{ $contract->start_date }}" name="start_date"
                                    class="form-control" id="start_date" placeholder="">
                                    <p>currently: {{ \Carbon\Carbon::parse($contract->start_date)->format(' M d/Y'); }}</p>
                                @error('start_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="end_date">End Date</label>
                                <input value="{{ $contract->end_date }}" type="date" name="end_date" class="form-control"
                                    id="end_date" placeholder="">
                                    <p>currently: {{ \Carbon\Carbon::parse($contract->end_date)->format(' M d/Y'); }}</p>
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
                        <button type="submit" class="btn btn-success">Save Contract</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
