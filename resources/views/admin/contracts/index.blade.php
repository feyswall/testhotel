@extends('pageLayouts.admin')

@section('title')
    <title>Records | Contracts</title>
@endsection

@section('content')
    <main class="content p-4">

         <div class="row justify-content-end">
                <div class="col-md-4 col-sm-12">
                     <div class="input-group mb-3">
                    <form action="/contracts">
                        @csrf
                        <select class="form-select" name="category">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-secondary" type="submit">Filter</button>
                    </form>
                </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <a href="#" class="btn btn-primary float-end mt-n1">Add Contract</a>
                </div>
            </div>


        <div class="container-fluid p-0 card">

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
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contracts as $contract)
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
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
