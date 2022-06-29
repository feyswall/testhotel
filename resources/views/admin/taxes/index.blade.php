@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Taxes</title>
@endsection

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Taxes</h1>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Available Taxes</h5>
                    </div>
                    <table class="table table-borderless my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tax Name</th>
                                <th>Description</th>
                                <th>Tax Rate</th>
                                <th class="d-none d-xl-table-cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taxes as $item)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="bg-light rounded-2">
                                                <i class="la la-hand-holding-usd h2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="d-none d-xxl-table-cell">
                                    <strong>
                                        @if ($item->type == 1)
                                        VAT
                                        @endif
                                    </strong>
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    {{$item->name}}
                                </td>
                                <td>{{$item->rate}}%</td>
                                <td class="d-none d-xl-table-cell">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit-tax-{{$item->id}}" class="btn btn-light">Edit</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="edit-tax-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Tax</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body m-3">

                                          <form method="POST" action="/tax/edit/{{$item->id}}" id="edit-tax-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mt-3">
                                                <div class="col col-md-12">
                                                    <select name="type" id="tax-type" class="form-control">
                                                        <option value="1" selected>VAT</option>
                                                        <option value="2" disabled>PAYEE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col col-md-12">
                                                    <input name="name" required value="{{$item->name}}" type="text" placeholder="Description" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col col-md-12">
                                                    <input required value="{{$item->rate}}" name="rate" min="0" type="number" placeholder="Tax rate (%)" class="form-control">
                                                </div>
                                            </div>
                                          </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button form="edit-tax-form" type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Add Tax</h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                           <form action="/save_tax" method="POST">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col col-md-12">
                                        <select name="type" id="tax-type" class="form-control">
                                            <option value="1" selected>VAT</option>
                                            <option value="2" disabled>PAYEE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col col-md-12">
                                        <input name="name" required type="text" placeholder="Description" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col col-md-12">
                                        <input name="rate" required min="0" type="number" placeholder="Tax rate (%)" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col col-md-12">
                                        <button type="submit" class="btn w-100 btn-success">Save Tax</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
