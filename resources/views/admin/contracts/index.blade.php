@extends('pageLayouts.admin')

@section('title')
    <title>Records | Contracts</title>
@endsection

@section('content')
    <main class="content p-4">

        <div class="container-fluid p-0">
            <a href="{{ route('contract.create') }}" class="btn btn-primary float-end mt-n1 mx-3">Add Contract</a>
            <form action="/contracts">
                @csrf
                <button class="btn btn-primary float-end mt-n1" type="submit">Filter</button>
                <a href="#" class="float-end mt-n1 text-decoration-none">
                    <select class="form-control choices-single" name="category">
                        <option value="">Filter Category</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}"@if ($item->id == $category_id) selected @endif>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </a>
            </form>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"> Contracts Records</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-buttons" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Party</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contracts as $contract)
                                        <tr>
                                            <td>{{ $contract->name }}</td>
                                            <td>{{ $contract->desc }}</td>
                                            <td>{{ $contract->party }}</td>
                                            <td>{{ $contract->category->name }}</td>
                                            <td>
                                                <a class="badge bg-warning ms-2 text-decoration-none" href="#">
                                                   2 months left
                                                </a>
                                            </td>
                                            <td>{{  \Carbon\Carbon::parse($contract->start_date)->format('M d/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($contract->end_date)->format('M d/y') }}</td>
                                            <td>
                                                <a href="{{ route('contract.show', $contract->id) }}" class="btn btn-outline-primary btn-sm">open</a>
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
