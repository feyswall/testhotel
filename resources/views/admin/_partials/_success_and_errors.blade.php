@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            <strong>Hello!</strong> {{ session()->get('success') }}
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            <strong>Hello!</strong> {{ session()->get('error') }}
        </div>
    </div>
@endif

@if (session()->has('modal'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            <strong>Hello!</strong> {{ session()->get('error') }}
        </div>
    </div>
@endif
