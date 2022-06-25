@php
    /**
     * Neccessary Classes that could be used directly in this
     * view
     */
    use \App\Http\Controllers\Admin\InStocksController; 
@endphp

@extends('pageLayouts.admin')


@section('title')
    <title>Stock || Trace</title>
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            @include('admin._partials._success_and_errors')

            @if( $errors->any() )
                <p class="lead text-danger">{{ $errors->first() }}</p>
            @endif

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"></h1>
            </div>

            <div class="row justify-content-end mb-3">
                <div class="col-lg-2 col-md-2">
                    
                    <button type="button" style="float: right" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#itemStockNewAdd">
                        Add Product
                    </button>


                                    
                                <div class="modal fade" id="itemStockNewAdd" tabindex="-1" style="display: none;" aria-hidden="true">

                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Items</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body m-3">

                                   
                                    <div class="row justify-content-center">
                                        <form action="{{ route('item.add.in.existing') }}" id="stock-item-add-new" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Stock Name</label>
                                                <input type="text" class="form-control" value="{{ $stock->name }}" disabled>
                                                <input name="stock_id" type="hidden" class="form-control" value="{{ $stock->id }}" readonly='readonly'>

                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Item Code</label>
                                                <input type="text" class="form-control" value="{{ $item->code }}" disabled>
                                                <input name="item_id" type="hidden"  value="{{ $item->id }}" readonly='readonly'>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">In Date</label>
                                                <input required name="inDate" value="{{ date('Y-m-d') }}" type="date" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Quantity</label>
                                                <input min="1" name="quantity" value="0" type="number" class="form-control">
                                            </div>                  
									    </form>
                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button form="stock-item-add-new" type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-12">
                                <div class="card">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-3">{{$item->desc}}</h5>
                </div>
                <div class="card-body">

                    <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Item code</th>
                                <th>date</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($inStocks as $inStock)
                                <tr>
                                    <td>{{ $inStock->id }}</td>
                                    <td>{{ $inStock->item->name }}</td>
                                    <td>{{  \Carbon\Carbon::parse($inStock->created_at)->format('d-M Y') }}</td>
                                    <td>{{ InStocksController::currentQuantity($inStock) }}</td>
                                    <td>
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#itemAddOrRemove-{{$inStock->id}}">
										edit
									</button>

                                    
                                    </td>
                                <div class="modal fade" id="itemAddOrRemove-{{$inStock->id}}" tabindex="-1" style="display: none;" aria-hidden="true">

                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body m-3">

                                    <div class="m3">
                                        <p class="lead">Product: <b>{{ $inStock->item->code }}</b></p>
                                        Added in: {{ \Carbon\Carbon::parse($inStock->created_at)->format('Y d-M') }}
                                        
                                        @php
                                            $initial_quantity = InStocksController::initialQuantity($inStock);
                                            $after_sale_quantity = InStocksController::outStockQuantity($inStock);
                                            $current_quantity = InStocksController::currentQuantity($inStock);
                                        @endphp

                                        <p class="lead">Current Quantity: {{ $current_quantity }}</p>
                                    </div>
                                    <div class="row justify-content-center">
                                        
                                        <form id="stock-item-modifications{{$inStock->id}}" method="POST" action="{{ route('admin.stock.items.modifications', $inStock->id ) }}">
                                            @method('put')
                                            @csrf

                                            <div>
                                                <label for="quantity">New Quantity</label>
                                                <input type="text" name="quantity" class="form-control" placeholder="Quantity">
                                            </div>

                                            <div>
                                            </div>
                                        </form>
                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button form="stock-item-modifications{{ $inStock->id }}" type="submit" class="btn btn-primary">Save changes</button>
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
                                <th>date</th>
                                <th>Quantity</th>
                                <th>action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
                </div>
            </div>
        </div>
    </main>
@endsection
