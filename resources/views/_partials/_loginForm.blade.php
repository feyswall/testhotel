<div class="text-center mb-4">
    <img src="{{ asset('assets/img/avatars/logo-dark.png') }}" alt="logo" width="50%" height="50%">
    {{-- <h1 class="h2">Welcome to Hotel Solutions</h1> --}}
    {{-- <p class="lead">
        Sign in
    </p> --}}
</div>

<div class="card">
    <div class="card-body">
        <div class="m-sm-4">

            <div class="text-center">
                {{-- <img src="img/avatars/avatar.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132"> --}}
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
    
                @if ( $errors->any() )
                {{-- <span class="text-danger text-center">{{ $errors->first() }}</span> --}}
                 <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>Login error!</strong> {{ $errors->first() }}
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control form-control-lg" 
                    type="email" value="{{ old('email') }}" name="email" placeholder="Enter your email">
                    
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control form-control-lg"
                     type="password" name="password" placeholder="Enter your password">
                    <small>
                        <a href="pages-reset-password.html">Forgot password?</a>
                    </small>
                </div>
                <div>
                    <label class="form-check">
                        <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked="">
                        <span class="form-check-label">
                            Remember me.
                        </span>
                    </label>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-lg btn-amber text-black">Sign in</button>
                    <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                </div>
            </form>
        </div>
    </div>
</div>