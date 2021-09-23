<?php
$ft = 0;
$counter = 0;
if (isset($_GET['ft']))
    $ft = $_GET['ft'];
?>
<div class="col-12 col-md-11 col-lg-10 order-md-first order-last">
    <div class="row mt-2"></div>

    {{--Custom Session Error--}}
    @include('_partials.custom_errors')

    {{--form request error--}}
    @include('_partials.errors')


    <div class="tab-content pt-2 pt-lg-4" id="v-pills-tabContent">
        <div class="tab-pane fade text-start show active" id="user_list" role="tabpanel">
            @include('admin._partials.user_list')
        </div>
        <div class="tab-pane fade text-start" id="role_list" role="tabpanel">
            @include('admin._partials.list_role')
        </div>
        <div class="tab-pane fade text-start" id="add_user" role="tabpanel">
            <h3 class="pb-2">افزودن کاربر</h3>
            <div>
                <form method="post" action="{{ route('addUser') }}" class="row flex-row-reverse justify-content-center">
                    @csrf
                    @include('admin._partials.add_user_form')
                </form>
            </div>
        </div>
        <div class="tab-pane fade text-start" id="add_role" role="tabpanel">
            <h3 class="pb-2">افزودن نقش</h3>
            <div>
                <form method="post" action="{{route('addRole')}}" class="row flex-row-reverse justify-content-center">
                    @csrf
                    @include('admin._partials.add_role_form')
                </form>
            </div>
        </div>
        <div class="tab-pane fade text-start" id="posts" role="tabpanel">
            <h3 class="pb-2">پست ها</h3>
            <div>
                <form method="post" action="{{route('addPost')}}" class="row flex-row-reverse justify-content-center" enctype="multipart/form-data">
                    @csrf
                    @include('admin._partials.add_post_form')
                </form>
            </div>
        </div>
    </div>
</div>

{{--Edit_User_Modal--}}
@include('admin._partials.edit_user_modal')
