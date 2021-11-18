@if(session('success'))
    <div class="col-12">
        <div class="alert alert-success alert-dismissible" role="alert" dir="rtl"> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@elseif(session('failed') )
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible" role="alert" dir="rtl"> {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
