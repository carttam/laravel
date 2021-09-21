@extends('main')

@section('title')
    خانه
@endsection
{{--Includes--}}
@section('sp_site')
    dir="rtl"
@endsection
{{--Css--}}
@section('include_css')
    <link rel="stylesheet" href="css/site/style.css">
@endsection

{{--JavaScript--}}
@section('include_js')
    <script src="js/site/main.js"></script>
@endsection

<?php
$login = \App\Http\Controllers\LoginController::checkLogin();
?>

@section('body')

    <!--Navbar-->
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
                    @if($login) {{--Lged In--}}
                    <li class="nav-item me-3 text-warning mt-1">
                        {{$login->full_name}}
                    </li>
                    <li class="nav-item me-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#postM"> <i class="bi bi-plus"></i> افزودن پست </a>
                    </li>
                    <li class="nav-item me-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-danger" href="{{route('clearSession')}}"> <i class="bi bi-plus"></i> خروج </a>
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
    {{--Errors--}}
    @include('_partials.custom_errors')

    @include('_partials.errors')
    <!--Body-->
    <div class="container-fluid d-flex justify-content-center mt-5">
        <div class="row justify-content-center">

            @foreach($posts as $post)
                <div class="col-12 col-lg-10 border d-flex justify-content-center mt-5">
                    <div class="card">
                        <img class="card-img-top" src="../storage/app/public/upload/{{$post->user->secret_key.'/'.$post->file_name}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->user->full_name}}</h5>
                            <p class="card-text">{{$post->description}}</p>
                        </div>
                        <div class="card-body">
                            <a class="card-link comments" data-id="{{$post->id}}">نظرات</a>
                            @if($login)
                                <a class="card-link add-comment" data-id="{{$post->id}}">نظر بده</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    {{--Modal_Comments--}}
    @include('site._partials.comments_modal')
    {{--Modal_AddPost--}}
    @include('site._partials.add_post_modal')
    {{--Modal_AddComment--}}
    @include('site._partials.add_comment_modal')
@endsection
