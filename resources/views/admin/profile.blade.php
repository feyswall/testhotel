@extends('pageLayouts.admin')

@section('title')
    <title>dashboard | page</title>
@endsection

@section('content')
<div class="main">

    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Profile</h1>

            <div class="row">
                <div class="col-md-7 col-xl-7">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile Details</h5>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('assets/img/avatars/avatar-4.jpg') }}" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128">
                            <h5 class="card-title mb-0">{{ Auth::user()->name }}</h5>
                            <div class="text-muted mb-2">{{ Auth::user()->roles[0]->name }}</div>

                            <div>
                                <a class="btn btn-primary btn-sm btn-block" href="#"><span data-feather="message-square"></span> Message</a>
                                <button type="button" class="btn btn-primary btn-sm btn-block"" data-bs-toggle="modal" data-bs-target="#defaultModalSuccess">
                                    Success
                                </button>
                                <div class="modal fade" id="defaultModalSuccess" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Admin Action Section</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body m-3">
                                                <div class="row">
                                                    <div class="col-12 col-xl-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-title">Form For Updates</h5>
                                                                <h6 class="card-subtitle text-muted">Admin Credentials informations.</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <form id="update-button" action="{{ route('admin.updateProfile', $user->id) }}" method="post">
                                                                    
                                                                    @csrf
                                                                    @method('PUT')
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
                                                                        <small>leave empty to leave it as it is..</small>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Password</label>
                                                                        <input type="password" class="form-control" placeholder="password confirmation" name="password_confirmation">
                                                                        {{-- <small>leave empty to leave it as it is..</small> --}}
                                                                    </div>
                                                                    
                                                                    <div class="mb-3">
                                                                        <label class="form-label w-100">File input</label>
                                                                        <input type="file" name="profile">
                                                                    </div>
                                                                </form>
                                                                <button type="submit" form="update-button" class="btn btn-success mt-3">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0">
                        
                        <hr class="my-0">
                        <div class="card-body">
                            <h5 class="h6 card-title">About</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">San Francisco, SA</a>
                                </li>

                                <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Works at <a href="#">GitHub</a></li>
                                <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> From <a href="#">Boston</a></li>
                            </ul>
                        </div>
                        <hr class="my-0">
                       
                    </div>
                </div>

                {{-- <div class="col-md-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Activities</h5>
                        </div>
                        <div class="card-body h-100">

                            <div class="d-flex align-items-start">
                                <img src="{{ asset('assets/img/avatars/avatar-5.jpg') }}" width="36" height="36" class="rounded-circle me-2" alt="Vanessa Tucker">
                                <div class="flex-grow-1">
                                    <small class="float-end text-navy">5m ago</small>
                                    <strong>Vanessa Tucker</strong> started following <strong>Christina Mason</strong><br>
                                    <small class="text-muted">Today 7:51 pm</small><br>

                                </div>
                            </div>

                            <hr>
                            <div class="d-flex align-items-start">
                                <img src="{{ asset('assets/img/avatars/avatar.jpg') }}" width="36" height="36" class="rounded-circle me-2" alt="Charles Hall">
                                <div class="flex-grow-1">
                                    <small class="float-end text-navy">30m ago</small>
                                    <strong>Charles Hall</strong> posted something on <strong>Christina Mason</strong>'s timeline<br>
                                    <small class="text-muted">Today 7:21 pm</small>

                                    <div class="border text-sm text-muted p-2 mt-1">
                                        Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem
                                        neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                                        tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                    </div>

                                    <a href="#" class="btn btn-sm btn-danger mt-1"><i class="feather-sm" data-feather="heart"></i> Like</a>
                                </div>
                            </div>

                            <hr>
                            <div class="d-grid">
                                <a href="#" class="btn btn-primary">Load more</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

        </div>
    </main>

</div>
@endsection






