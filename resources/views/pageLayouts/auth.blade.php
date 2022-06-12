<!-- made by east coders -->

<!-- we need this layout for login and registration pages for all users -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	@include('_partials._head')
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default" class="logo-dark">


    <main class="d-flex w-100 h-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
    
                        @yield('content')
    
                    </div>
                </div>
            </div>
        </div>
    </main>


	<!-- down script -->
	@include('_partials._downScript')

	@yield('ourScript')
</body>

</html>

