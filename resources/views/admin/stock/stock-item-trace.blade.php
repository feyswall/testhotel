@extends('pageLayouts.admin')


@section('title')
    <title>stock | trace</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            @include('admin._partials._success_and_errors')
            {{-- <a href="/customers/create" class="btn btn-primary float-end mt-n1">New Customer</a> --}}
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"></h1>
            </div>


            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Clients</h5>
                </div>
                <div class="card-body">

                    <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Customer names</th>
                                <th>date</th>
                                <th>Quantity</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($inStocks as $inStock)
                                <tr>
                                    <td>{{ $inStock->id }}</td>
                                    <td>{{ $inStock->item->name }}</td>
                                    <td>{{  \Carbon\Carbon::parse($inStock->created_at)->format('y M-d') }}</td>
                                    <td>progress...</td>
                                    <td>
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#itemAddOrRemove-{{$inStock->id}}">
										add & remove
									</button>

                                    
                                    </td>
                                <div class="modal fade" id="itemAddOrRemove-{{$inStock->id}}" tabindex="-1" style="display: none;" aria-hidden="true">

                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add or Remove Items</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body m-3">

                                    <div class="m3">
                                        <p class="lead">Product: <b>{{ $inStock->item->code }}</b></p>
                                        Added in: {{ \Carbon\Carbon::parse($inStock->created_at)->format('Y d-M') }}
                                        
                                        @php
                                            $initial_quantity = $inStock->quantity;
                                            $after_sale_quantity = $inStock->outStocks ? $inStock->outStocks->sum('quantity') : 0 ;
                                            $current_quantity = $initial_quantity - $after_sale_quantity;
                                        @endphp

                                        <p class="lead">Current Quantity: {{ $current_quantity }}</p>
                                    </div>
                                    <div class="row justify-content-center">
                                        
                                        <form id="stock-item-modifications" method="POST" action="{{ route('admin.stock.items.modifications', $inStock->id ) }}">
                                            @method('put')
                                            @csrf
                                            <h3 class="lead">Choose Operation</h3>
                                            <label class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="operation" checked>
                                                <span class="form-check-label">
                                                    Adding  {{ $inStock->code }}
                                                </span>
                                            </label>
                                            <label class="form-check">
                                                <input class="form-check-input" type="radio" value="0" name="operation">
                                                <span class="form-check-label">
                                                    Removing  {{ $inStock->code  }}
                                                </span>
                                            </label>

                                            <div>
                                                <label for="quantity"></label>
                                                <input type="text" name="quantity" class="form-control" placeholder="Quantity">
                                            </div>

                                            <div>
                                            </div>
                                        </form>
                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button form="stock-item-modifications" type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </tr> 
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sn</th>
                                <th>Customer names</th>
                             
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
