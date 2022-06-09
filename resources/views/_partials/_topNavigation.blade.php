<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <ul class="navbar-nav d-none d-lg-block">
        <li class="nav-item px-2 dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Back Office 
            </a>
            <div class="dropdown-menu dropdown-menu-start dropdown-mega" aria-labelledby="servicesDropdown">
                <div class="d-md-flex align-items-start justify-content-start">
                    <div class="dropdown-mega-list">
                        {{-- <div class="dropdown-header">UI Elements</div> --}}
                        <a class="dropdown-item" href="#">Taxes</a>
                        <a class="dropdown-item" href="#">Attributes</a>
                        <a class="dropdown-item" href="#">Suppliers</a>
                        <a class="dropdown-item" href="#">Employees</a>
                    </div>
                    <div class="dropdown-mega-list">
                        {{-- <div class="dropdown-header">UI Elements</div> --}}
                        <a class="dropdown-item" href="#">Customers</a>
                        <a class="dropdown-item" href="#">Item categories</a>
                        <a class="dropdown-item" href="#">Expenses categories</a>
                        <a class="dropdown-item" href="#">Contracts categories</a>
                    </div>
                    <div class="dropdown-mega-list">
                        {{-- <div class="dropdown-header">UI Elements</div> --}}
                        <a class="dropdown-item" href="#">Discounts</a>
                        <a class="dropdown-item" href="#">Users</a>
                        </div>
                </div>
            </div>
        </li>
    </ul>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator">4</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        4 New Notifications
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-danger" data-feather="alert-circle"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Update completed</div>
                                    <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                    <div class="text-muted small mt-1">30m ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-warning" data-feather="bell"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Lorem ipsum</div>
                                    <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-primary" data-feather="home"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Login from 192.186.1.8</div>
                                    <div class="text-muted small mt-1">5h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-success" data-feather="user-plus"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">New connection</div>
                                    <div class="text-muted small mt-1">Christina accepted your request.</div>
                                    <div class="text-muted small mt-1">14h ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="message-square"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                    <div class="dropdown-menu-header">
                        <div class="position-relative">
                            4 New Messages
                        </div>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="{{ asset('assets/img/avatars/avatar-5.jpg') }}" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Vanessa Tucker</div>
                                    <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
                                    <div class="text-muted small mt-1">15m ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="{{ asset('assets/img/avatars/avatar-2.jpg') }}" class="avatar img-fluid rounded-circle" alt="William Harris">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">William Harris</div>
                                    <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="{{ asset('assets/img/avatars/avatar-4.jpg') }}" class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Christina Mason</div>
                                    <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
                                    <div class="text-muted small mt-1">4h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="{{ asset('assets/img/avatars/avatar-3.jpg') }}" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Sharon Lessman</div>
                                    <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
                                    <div class="text-muted small mt-1">5h ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all messages</a>
                    </div>
                </div>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-flag dropdown-toggle" href="#" id="languageDropdown" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/flags/us.png') }}" alt="English">
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    <a class="dropdown-item" href="#">
                        <img src="img/flags/us.png" alt="English" width="20" class="align-middle me-1">
                        <span class="align-middle">English</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <img src="img/flags/es.png" alt="Spanish" width="20" class="align-middle me-1">
                        <span class="align-middle">Spanish</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <img src="img/flags/ru.png" alt="Russian" width="20" class="align-middle me-1">
                        <span class="align-middle">Russian</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <img src="img/flags/de.png" alt="German" width="20" class="align-middle me-1">
                        <span class="align-middle">German</span>
                    </a>
                </div>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="maximize"></i>
                    </div>
                </a>
            </li> --}}
            <li class="nav-item dropdown">
                <a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded" alt="Latram">
                </a>
                <div class="dropdown-menu dropdown-menu-end">
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
                    
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="pages-settings.html">
                        <i class="align-middle me-1" data-feather="settings"></i> Sign Up</a>
                    <div class="dropdown-divider"></div>

                    <form method="post" id="logout-form" action="{{ route('logout') }}">
                        @csrf
                            @can('grob_users')
                            <button type="submit" form="logout-form" class="dropdown-item">Log out</button>
                            @endcan
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>