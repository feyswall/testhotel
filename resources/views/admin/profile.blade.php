@extends('pageLayouts.admin')

@section('title')
    <title>dashboard | page</title>
@endsection

@section('content')
<div class="main">

    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3 text-center">Profile</h1>
            <div class="row justify-content-center">
                <div class="col-md-5 col-xl-5">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile Details</h5>
                        </div>
                        <div class="card-body">
                            <img style="margin-left: 230px" src="{{ asset('assets/img/avatars/avatar-4.jpg') }}" alt="Christina Mason" class="img-fluid rounded-circle mb-2 text-center" width="128" height="128">
                            <h5 class="card-title mb-0">{{ Auth::user()->name }}</h5>
                            <div class="text-muted mb-2">{{ Auth::user()->roles[0]->name }}</div>
                        </div>
                        <hr class="my-0">
                        
                        <hr class="my-0">
                        <div class="card-body">
                            <form id="update-button" action="{{ route('admin.updateProfile', $user->id) }}" method="post">
                                
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="user_name" class="form-control" value="{{ $user->user_name }}" placeholder="User name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">First name</label>
                                    <input type="first_name" class="form-control" value="{{ $user->first_name }}" placeholder="First name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Last name</label>
                                    <input type="last_name" class="form-control" value="{{ $user->last_name }}" placeholder="Last name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" placeholder="Email">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" placeholder="Password">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confrim Password</label>
                                    <input type="confirm_password" class="form-control" placeholder="password confirmation" name="password_confirmation">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label w-100">File input</label>
                                    <input type="file" name="profile">
                                </div>
                            </form>
                           <center><button type="submit" form="update-button" class="btn btn-success mt-3">Save</button></center> 
                        </div>
                        <hr class="my-0">
                       
                    </div>
                </div>
            </div>

        </div>
    </main>

</div>
@endsection






