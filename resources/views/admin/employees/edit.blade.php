@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Employees</title>
@endsection

@section('content')
    <main class="content p-4">
        <div class="container-fluid p-0">

            <div class="row justify-content-end">
                <div class="col-md-2">
            <a href="/employees" class="btn btn-primary">all employees</a>
                </div>
            </div>

            <div class="row justify-content-center">
                
                <div class="col-md-8 col-sm-12 col-lg-6">

            @include('admin._partials._success_and_errors')

                    <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                    <p class="text-danger mb-3">{{ $errors->first() }}</p>
                    @endif

                    <form method="POST" id="employeeBtn" action="{{ route('employees.update', $employee->id) }}">
                        @csrf
                    @method('put')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="name" name="name" class="form-control" value="{{ $employee->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salary</label>
                            <input type="Salary" name="salary" class="form-control" value="{{ $employee->salary }}">
                        </div>
                        <button type="submit" class="btn btn-primary">update</button>
                    </form>

                </div>
            </div>
                </div>
            </div>
        </div>
    </main>
@endsection
