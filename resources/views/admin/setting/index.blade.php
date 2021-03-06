@extends('pageLayouts.admin')

@section('title')
    <title>Back Office | Setting</title>
@endsection

@section('content')
   
    <main class="content p-4">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">System Setting</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    @include('admin._partials._success_and_errors')
                    <div class="card">
                        <div class="card-body">
                            <form action="/update_setting" method="POST">
                                @csrf 
                                @method('PUT')
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input name="email" value="{{$data['email'] ?? null}}" type="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="website">Website</label>
                                        <input name="website" value="{{$data['website'] ?? null}}" type="text" class="form-control" id="website" placeholder="Company Website">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input name="phone" value="{{$data['phone']  ?? null}}" type="text" class="form-control" id="phone" placeholder="Contact phone">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="box">Post Office Box</label>
                                        <input name="box" value="{{$data['box']  ?? null}}" type="text" class="form-control" id="box" placeholder="P.O.Box Number">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="street">Street Address</label>
                                        <input name="street" value="{{$data['street']  ?? null}}" type="text" class="form-control" id="street" placeholder="Street Adress">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="state">State</label>
                                        <input name="state" value="{{$data['state']  ?? null}}" type="text" class="form-control" id="state" placeholder="State Address">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="tin">TIN Number</label>
                                        <input name="tin" value="{{$data['tin']  ?? null}}" type="text" class="form-control" id="tin" placeholder="TIN number">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="vrn">VRN Number</label>
                                        <input name="vrn" value="{{$data['vrn'] ?? null}}" type="text" class="form-control" id="vrn" placeholder="VRN number">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="zrb">ZRB</label>
                                        <input name="zrb" value="{{$data['zrb'] ?? null}}" type="text" class="form-control" id="zrb" placeholder="ZRB number">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
