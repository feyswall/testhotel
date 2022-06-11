@extends('pageLayouts.admin')

@section('title')
    <title>Inventory | Warehouses</title>
@endsection

@section('content')
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">
                <a href="#" class="btn btn-primary float-end mt-n1">Add Warehouse</a>
                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle"> Warehouses</h1>
                </div>

                <div class="row">
                    <div class="col-12">
                        @php
                            $warehouses = [
                                ['name' => 'Wami Code Warehouse', 'location' => 'Tumbi', 'items' => 234]
                            ];
                        @endphp
                        <div class="row">
                            @foreach ($warehouses as $item)
                            <div class="col col-md-3">
                                <div class="card flex-fill">
                                    <div class="card-body py-4">
                                        <div class="float-end text-success">
                                            <button class="btn btn-outline-secondary">Manage</button>
                                        </div>
                                        <h4 class="mb-2">{{ $item['name'] }}</h4>
                                        <div class="mb-1">
                                            <strong>
                                                {{$item['items']}}
                                            </strong>
                                            Items
                                        </div>
                                        <div>
                                            Location: {{$item['location']}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
@endsection
