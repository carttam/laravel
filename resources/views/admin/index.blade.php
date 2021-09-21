@extends('main')

@section('title')
    پنل ادمین
@endsection

{{--Includes--}}

    {{--Css--}}
@section('include_css')
<link rel="stylesheet" href="css/admin/style.css">
@endsection

    {{--JavaScript--}}
@section('include_js')
<script src="js/admin/main.js"></script>
@endsection
{{--Body--}}

@section('body')
    <!--NavBar-->
    @include('admin._partials.top_navbar')

    <div class="container-fluid d-flex justify-content-center">
        <div class="row w-100">
            <!--Body-->
            @include('admin._partials.body')
            <!--SideBar-->
            @include('admin._partials.side_bar')
        </div>
    </div>
@endsection
