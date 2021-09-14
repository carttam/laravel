<?php
$ft = 0;
$counter = 0;
if (isset($_GET['ft']))
    $ft = $_GET['ft'];
?>
<div class="col-12 col-md-11 col-lg-10 order-md-first order-last">
    <div class="row mt-2"></div>

    {{--Custom Session Error--}}
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


    <div class="tab-content pt-2 pt-lg-4" id="v-pills-tabContent">
        <div class="tab-pane fade text-start show active" id="user_list" role="tabpanel">
            <h3 class="pb-2">لیست کاربران</h3>
            <div class="table-responsive">
                @if($users->count() < $ft)
                <div class="alert alert-danger" dir="rtl">
                    داده ای وجود ندارد.
                </div>
                @else
                    <table class="table table-striped table-hover table-info">
                        <thead>
                        <tr>
                            <th scope="col">شماره تماس</th>
                            <th scope="col">نقش</th>
                            <th scope="col">ایمیل</th>
                            <th scope="col">نام و نام خانوادگی</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <?php $counter++; ?>
                            @if($counter < $ft)
                                @continue
                            @endif
                            <tr>
                                <td>+98-{{ $user->phone_number }}</td>
                                <td>{{ $user->role->type }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $counter }}</td>
                            </tr>
                            @if($counter > ($ft+49))
                                @break
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a id="prevP" class="page-link rounded-0 rounded-end" href="#">Previous</a></li>
                        <li class="page-item"><a id="nextP" class="page-link rounded-0 rounded-start" href="?ft=50">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="tab-pane fade text-start" id="role_list" role="tabpanel">
            <h3 class="pb-2">لیست نقش ها</h3>
            <div>
                <table class="table table-striped table-hover table-info">
                    <thead>
                    <tr>
                        <th scope="col">سطح</th>
                        <th scope="col">نقش</th>
                        <th scope="col">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1; ?>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->level }}</td>
                            <td>{{ $role->type }}</td>
                            <td>{{ $counter }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
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
