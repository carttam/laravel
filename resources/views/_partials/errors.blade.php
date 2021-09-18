{{--form request error--}}
@if($errors->any())
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible" role="alert" dir="rtl">

            <ol>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
