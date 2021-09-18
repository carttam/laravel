@extends('main')

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
        <a class="navbar-brand ms-2" href="#">
            <img src="ico.png" width="64" height="64" alt="top_icon">
        </a>
        <div class="d-inline-block me-2">
            {{--Check Login Part--}}
            @if($login)
                <p class="text-warning">{{$login->full_name}}</p>
            @else
                <a class="btn btn-outline-warning" href="{{route('login')}}">ورود</a>
                <a class="btn btn-outline-warning" href="{{route('signup')}}">ثبت نام</a>
            @endif

        </div>
    </nav>
    <!--Body-->
    <div class="container mt-5">
        <div class="row justify-content-center">

            @foreach($posts as $post)
                <div class="col-8 border d-flex justify-content-center mt-5">
                    <div class="card">
                        <img class="card-img-top" src="../storage/app/upload/{{$post->user->secret_key.'/'.$post->file_name}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->user->full_name}}</h5>
                            <p class="card-text">{{$post->description}}</p>
                        </div>
                        <div class="card-body">
                            <a class="card-link comments" data-id="{{$post->id}}">نظرات</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    {{--Modal--}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">نظرات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-content">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted"></h6>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>



@endsection
