<div class="text-center mt-4">
    <h1 class="h2">Welcome to Hotel Solutions</h1>
    <p class="lead">
        Sign in here...
    </p>
</div>

<div class="card">
    <div class="card-body">
        <div class="m-sm-4">
            <div class="text-center">
                {{-- <img src="img/avatars/avatar.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132"> --}}
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
    
                @if ( $errors->all() )
                <span class="text-danger text-center">{{ $errors->all()[0] }}</span>
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
                            Remember me next time
                        </span>
                    </label>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                    <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                </div>
            </form>
        </div>
    </div>
</div>