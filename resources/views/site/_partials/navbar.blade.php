<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand ms-2" href="#">
            <img src="ico.png" width="64" height="64" alt="top_icon">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                {{--Check Login Part--}}
                @if(Auth::check()) {{--Lged In--}}
                <li class="nav-item me-3 text-warning mt-1">
                    {{Auth::user()->full_name}}
                </li>
                @if(\App\Http\Controllers\LoginController::check_user_has_super_permission(Auth::user()->role->level))
                    <li class="nav-item me-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-info" href="{{route('admin')}}"> <i class="bi bi-box-arrow-right"></i> پنل ادمین </a>
                    </li>
                @endif
                <li class="nav-item me-3 mt-2 mt-lg-0">
                    <a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#postM"> <i class="bi bi-plus"></i> افزودن پست </a>
                </li>
                <li class="nav-item me-3 mt-2 mt-lg-0">
                    <a class="btn btn-outline-danger" href="{{route('clearSession')}}"> <i class="bi bi-x"></i> خروج </a>
                </li>
                @else {{--Must SignUp--}}
                <li class="nav-item me-3 mt-2 mt-lg-0">
                    <a class="btn btn-outline-warning" href="{{route('login')}}">ورود</a>
                </li>
                <li class="nav-item me-3 mt-2 mt-lg-0">
                    <a class="btn btn-outline-warning" href="{{route('signup')}}">ثبت نام</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
