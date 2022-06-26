@extends('pageLayouts.admin')

@section('title')
    <title>complementry | record</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <a href="{{ route('complementary.out.stock.create') }}" class="btn btn-primary float-end mt-n1">New Record</a>


            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Complementary</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatables-buttons" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($outStocks as $outStock)
                                        <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                        </tr>                                        
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
