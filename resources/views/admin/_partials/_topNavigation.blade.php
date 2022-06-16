<nav class="navbar navbar-expand navbar-light navbar-bg shadow-none border-bottom">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <ul class="navbar-nav d-none d-lg-block">
        <li class="nav-item px-2 dropdown">
            <a class="nav-link dropdown-toggle border" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Back Office Configurations
            </a>
            <div class="dropdown-menu dropdown-menu-start dropdown-mega" aria-labelledby="servicesDropdown">
                <div class="d-md-flex align-items-start justify-content-start">
                    <div class="dropdown-mega-list">
                        {{-- <div class="dropdown-header">UI Elements</div> --}}
                        <a class="dropdown-item" href="/settings">Setting</a>
                        <a class="dropdown-item" href="/attributes">Attributes</a>
                        <a class="dropdown-item" href="/suppliers">Suppliers</a>
                        <a class="dropdown-item" href="/employees">Employees</a>
                    </div>
                    <div class="dropdown-mega-list">
                        {{-- <div class="dropdown-header">UI Elements</div> --}}
                        <a class="dropdown-item" href="/customers">Customers</a>
                        <a class="dropdown-item" href="/categories/1">Item categories</a>
                        <a class="dropdown-item" href="/categories/2">Expenses categories</a>
                        <a class="dropdown-item" href="/categories/3">Contracts categories</a>
                    </div>
                    <div class="dropdown-mega-list">
                        <a class="dropdown-item" href="/methods">Payment methods</a>
                        <a class="dropdown-item" href="/discounts">Discounts</a>
                        <a class="dropdown-item" href="/users">Users</a>
                        </div>
                </div>
            </div>
        </li>
    </ul>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <li class="nav-item mt-1">
                <form method="post" id="logout-form" action="{{ route('logout') }}">
                    @csrf
                        @can('grob_users')
                        <button type="submit" form="logout-form" class="btn text-danger">Sign Out</button>
                        @endcan
                </form>
            </li>

            <li class="nav-item mt-1">
                <a href="/profile" class="btn">{{ ucfirst(Auth::user()->user_name) }}</a>
            </li>
         
            <li class="nav-item">
                <a class="nav-icon pe-md-0" href="/profile">
                    <img src="{{ asset('assets/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded-circle" alt="Latram">
                </a>
                {{-- <div class="dropdown-menu dropdown-menu-end">
                    <small class="dropdown-item">
                        {{ Auth::user()->roles()->first() ? Auth::user()->roles()->first()->name: 'empty' }}
                    </small>
                    <a class="dropdown-item">
                        <h4>{{ Auth::user() ? Auth::user()->user_name : 'empty' }}</h4>
                    </a>

                    <a class="dropdown-item" href="{{ route('admin.getProfile', Auth::user()->id) }}">
                        <i class="align-middle me-1" data-feather="user"></i> 
                        Profile
                    </a>
                                   
                   
                </div> --}}
            </li>
        </ul>
    </div>
</nav>