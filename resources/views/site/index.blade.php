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
    @include('site._partials.navbar')
    {{--Errors--}}
    @include('_partials.custom_errors')

    @include('_partials.errors')
    <!--Body-->
    @include('site._partials.body')
    {{--Modal_Comments--}}
    @include('site._partials.comments_modal')
    {{--Modal_AddPost--}}
    @include('site._partials.add_post_modal')
    {{--Modal_AddComment--}}
    @include('site._partials.add_comment_modal')
@endsection
