<!-- This is admin dashboard layout alone -->
@extends('pageLayouts.admin')

@section('title')
    <title>Dashboard | page</title>
@endsection

@section('content')
    <main class="content p-4">
        <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3>Dashboard</h3>

                </div>

                <div class="col-auto ms-auto text-end mt-n1">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Quick Actions
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/items/create">Add Items</a>
                            <a class="dropdown-item" href="/warehouses/create">Add Warehouse</a>
                            <a class="dropdown-item" href="/customers/create">New Customer</a>
                            <a class="dropdown-item" href="/suppliers/create">New Supplier</a> 
                            <a class="dropdown-item" href="/contracts/create">New Contract</a>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <a href="/warehouses" class="text-decoration-none">
                        <div class="card custo-blue rounded-0 shadow-none"> 
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title text-black">Warehouses</h5>
                                    </div>
    
                                    <div class="col-auto">
                                        <div class="stat bg-light text-black">
                                            <i class="align-middle" data-feather="map-pin"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">4</h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="/employees" class="text-decoration-none">
                        <div class="card custo-red rounded-0 shadow-none">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title text-black">Employees</h5>
                                    </div>
    
                                    <div class="col-auto">
                                        <div class="stat bg-light text-black">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">46</h1>
                                
                            </div>
                        </div></a>
                </div>
                <div class="col-sm-6 col-xl-3">
                   <a href="/suppliers" class="text-decoration-none">
                    <div class="card btn-amber rounded-0 shadow-none">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title text-black">Suppliers</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat bg-light text-black">
                                        <i class="align-middle" data-feather="truck"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">16</h1>
                           
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="/customers" class="text-decoration-none">
                        <div class="card custo-green rounded-0 shadow-none">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title text-black">Customers</h5>
                                    </div>
    
                                    <div class="col-auto">
                                        <div class="stat bg-light text-black">
                                            <i class="align-middle" data-feather="shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">126</h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </main>
@endsection
