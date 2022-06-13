<!-- This is admin dashboard layout alone -->
@extends('pageLayouts.admin')

@section('title')
    <title>Dashboard | page</title>
@endsection

@section('content')
    <main class="content">
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
                    <div class="card custo-blue"> 
                        <div class="card-body">
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
                            <div class="mb-0">
                                <a href="/warehouses"><span class="text-black">Click to view more >></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card custo-red">
                        <div class="card-body">
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
                            <div class="mb-0">
                                <a href="/employees"><span class="text-black">Click to view more >></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card btn-amber">
                        <div class="card-body">
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
                            <div class="mb-0">
                                <a href="/suppliers" class="text-black"><span>Click to view more >></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card custo-green">
                        <div class="card-body">
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
                            <div class="mb-0">
                                <a href="/customers"><span class="text-black">Click to view more >></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-lg-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <a href="/new_sales" class="btn btn-success text-light">Record Sales</a>
                            </div>
                            <h5 class="card-title mb-0">Daily Sales: 5,670,000 Tsh</h5>
                        </div>
                        <table class="table table-sm table-striped my-0">
                            <thead>
                                <tr>
                                    <th>Price</th>
                                    <th class="d-none d-xl-table-cell">ETH</th>
                                    <th class="d-none d-xl-table-cell">BTC</th>
                                    <th>Sum(BTC)</th>
                                </tr>
                            </thead>
                            <tbody class="text-end">
                                <tr>
                                    <td>0.03892501</td>
                                    <td class="d-none d-xl-table-cell">32.07831558</td>
                                    <td class="d-none d-xl-table-cell">1.24864875</td>
                                    <td>1.26329659</td>
                                </tr>
                                <tr>
                                    <td>0.03893754</td>
                                    <td class="d-none d-xl-table-cell">4.97546187</td>
                                    <td class="d-none d-xl-table-cell">0.19373225</td>
                                    <td>1.45702884</td>
                                </tr>
                                <tr>
                                    <td>0.03895189</td>
                                    <td class="d-none d-xl-table-cell">0.00288098</td>
                                    <td class="d-none d-xl-table-cell">0.00011222</td>
                                    <td>1.45714106</td>
                                </tr>
                                <tr>
                                    <td>0.03896593</td>
                                    <td class="d-none d-xl-table-cell">1.37722262</td>
                                    <td class="d-none d-xl-table-cell">0.05366476</td>
                                    <td>1.51080582</td>
                                </tr>
                                <tr>
                                    <td>0.03897932</td>
                                    <td class="d-none d-xl-table-cell">7.91612747</td>
                                    <td class="d-none d-xl-table-cell">0.30856527</td>
                                    <td>1.81937109</td>
                                </tr>
                                <tr>
                                    <td>0.03897933</td>
                                    <td class="d-none d-xl-table-cell">0.32745500</td>
                                    <td class="d-none d-xl-table-cell">0.01276398</td>
                                    <td>1.83213507</td>
                                </tr>
                                <tr>
                                    <td>0.03899180</td>
                                    <td class="d-none d-xl-table-cell">0.00758003</td>
                                    <td class="d-none d-xl-table-cell">0.00029556</td>
                                    <td>1.83243063</td>
                                </tr>
                                <tr>
                                    <td>0.03899784</td>
                                    <td class="d-none d-xl-table-cell">2.05272745</td>
                                    <td class="d-none d-xl-table-cell">0.08005194</td>
                                    <td>1.91248257</td>
                                </tr>
                                <tr>
                                    <td>0.03899998</td>
                                    <td class="d-none d-xl-table-cell">2.59143162</td>
                                    <td class="d-none d-xl-table-cell">0.10106578</td>
                                    <td>2.01354835</td>
                                </tr>
                                <tr>
                                    <td>0.03899999</td>
                                    <td class="d-none d-xl-table-cell">3.00000000</td>
                                    <td class="d-none d-xl-table-cell">0.11699997</td>
                                    <td>2.13054832</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <a href="/expenses/create" class="btn btn-danger text-light">Record Expenses</a>
                            </div>
                            <h5 class="card-title mb-0">Daily Expenses: 120,000 Tsh</h5>
                        </div>
                        <table class="table table-sm table-striped my-0">
                            <thead>
                                <tr>
                                    <th>Price</th>
                                    <th class="d-none d-xl-table-cell">ETH</th>
                                    <th class="d-none d-xl-table-cell">BTC</th>
                                    <th>Sum(BTC)</th>
                                </tr>
                            </thead>
                            <tbody class="text-end">
                                <tr>
                                    <td>0.03892000</td>
                                    <td class="d-none d-xl-table-cell">0.22446452</td>
                                    <td class="d-none d-xl-table-cell">0.00873616</td>
                                    <td>0.00873616</td>
                                </tr>
                                <tr>
                                    <td>0.03890500</td>
                                    <td class="d-none d-xl-table-cell">66.39390000</td>
                                    <td class="d-none d-xl-table-cell">2.58305468</td>
                                    <td>2.59179084</td>
                                </tr>
                                <tr>
                                    <td>0.03890132</td>
                                    <td class="d-none d-xl-table-cell">56.55334798</td>
                                    <td class="d-none d-xl-table-cell">2.19999989</td>
                                    <td>4.79179073</td>
                                </tr>
                                <tr>
                                    <td>0.03890053</td>
                                    <td class="d-none d-xl-table-cell">0.08285351</td>
                                    <td class="d-none d-xl-table-cell">0.00322305</td>
                                    <td>4.79501378</td>
                                </tr>
                                <tr>
                                    <td>0.03889706</td>
                                    <td class="d-none d-xl-table-cell">15.61516705</td>
                                    <td class="d-none d-xl-table-cell">0.60738409</td>
                                    <td>5.40239787</td>
                                </tr>
                                <tr>
                                    <td>0.03888117</td>
                                    <td class="d-none d-xl-table-cell">12.84070897</td>
                                    <td class="d-none d-xl-table-cell">0.49926179</td>
                                    <td>5.90165966</td>
                                </tr>
                                <tr>
                                    <td>0.03885500</td>
                                    <td class="d-none d-xl-table-cell">0.99800000</td>
                                    <td class="d-none d-xl-table-cell">0.03877729</td>
                                    <td>5.94043695</td>
                                </tr>
                                <tr>
                                    <td>0.03884325</td>
                                    <td class="d-none d-xl-table-cell">0.20552300</td>
                                    <td class="d-none d-xl-table-cell">0.00798318</td>
                                    <td>5.94842013</td>
                                </tr>
                                <tr>
                                    <td>0.03883474</td>
                                    <td class="d-none d-xl-table-cell">7.58480860</td>
                                    <td class="d-none d-xl-table-cell">0.29455407</td>
                                    <td>6.24297420</td>
                                </tr>
                                <tr>
                                    <td>0.03881616</td>
                                    <td class="d-none d-xl-table-cell">0.25000000</td>
                                    <td class="d-none d-xl-table-cell">0.00970404</td>
                                    <td>6.25267824</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
