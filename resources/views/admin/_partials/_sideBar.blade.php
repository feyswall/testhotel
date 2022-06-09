<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="sidebar-brand-text align-middle">
                Dashboard
            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewbox="0 0 24 24" fill="none"
                stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF"
                style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            <li class="sidebar-item">

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>    
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#inventory" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="database"></i> <span class="align-middle">Inventory</span>
                </a>
                <ul id="inventory" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Items</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Stocks</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Warehouse</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#records" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Records & Reports</span>
                </a>
                <ul id="records" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Sales records</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Purchase records</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Expenses records</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/back_office_page">
                    <i class="align-middle" data-feather="share"></i> <span class="align-middle">Back Office</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-invoice.html">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
