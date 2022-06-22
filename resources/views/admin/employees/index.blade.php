@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Employees</title>
@endsection

@section('content')
    <main class="content p-4">
        <div class="container-fluid p-0">

            <div class="mb-2 mt-2">
                @include('admin._partials._success_and_errors')
            </div>

            <a href="#" data-bs-toggle="modal" data-bs-target="#newEmployee" class="btn btn-primary float-end mt-n1">New Employee</a>

            <div class="modal fade" id="newEmployee" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Register Employee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">
                            @if ($errors->any())
                                <p class="text-danger mb-3">{{ $errors->first() }}</p>
                            @endif
                           <form method="POST" id="employeeBtn" action="{{ route('employees.store') }}">
                               @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="name" name="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Salary</label>
                                    <input type="Salary" name="salary" class="form-control" value="{{ old('salary') }}">
                                </div>
                               
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="employeeBtn" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>



            
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Employees</h1>
            </div>
            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)                                                                           <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->created_at }}</td>
                                        <td>{{ $employee->salary }}</td>
                                       <td class="table-action">
                                            <a  href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-primary btn-sm" form="edit-emp" ><svg xmlns="" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                        </td>
                                    </tr>
                                    @endforeach                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
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
