@if(request()->query('is_deleted'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $title }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
