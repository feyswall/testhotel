@props(['type', 'init', 'errorLog'])

@error('type')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            <strong>{{ $type }}</strong> {{ $errorLog }}
        </div>
    </div>
@enderror
