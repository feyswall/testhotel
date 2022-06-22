<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar logo-dark">
        <a class="sidebar-brand" href="/dashboard">
            <img src="{{ asset('assets/img/avatars/logo-dark.png') }}" alt="" width="100%" height="100%">
        </a>

        <hr>

        <ul class="sidebar-nav">
            {{-- <li class="sidebar-header">
                Pages
            </li> --}}
            <li class="sidebar-item">

            <li class="sidebar-item">
                <a class="sidebar-link" href="/dashboard">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>    
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#inventory" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="database"></i> <span class="align-middle">Inventory</span>
                </a>
                <ul id="inventory" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="/items">Items</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/stocks">Stocks</a></li>
                    {{-- <li class="sidebar-item"><a class="sidebar-link" href="/warehouses">Warehouses</a></li> --}}
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#records" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Records & Reports</span>
                </a>
                <ul id="records" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="/sales/2">Sales records</a></li>
                    {{-- <li class="sidebar-item"><a class="sidebar-link" href="/purchases">Purchase records</a></li> --}}
                    <li class="sidebar-item"><a class="sidebar-link" href="/expenses">Expenses records</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/contracts">Contracts records</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/backoffice">
                    <i class="align-middle" data-feather="share"></i> <span class="align-middle">Back Office</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/profile">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Account Settings</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
