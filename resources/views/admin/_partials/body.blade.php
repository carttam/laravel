<?php
$counter = 1;
?>
<div class="col-12 col-md-11 col-lg-10 order-md-first order-last">
    <div class="row mt-2"></div>
    @if(session('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible" role="alert" dir="rtl"> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @elseif(session('failed'))
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible" role="alert" dir="rtl"> {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="tab-content pt-2 pt-lg-4" id="v-pills-tabContent">
        <div class="tab-pane fade text-start show active" id="user_list" role="tabpanel">
            <h3 class="pb-2">لیست کاربران</h3>
            <div class="table-responsive">
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
                        <tr>
                            <td>+98-{{ $user->phone_number }}</td>
                            <td>{{ $user->role->type }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $counter }}</td>
                        </tr>
                        <?php $counter++; ?>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $counter-1 }}</td>
                    </tr>
                    </tfoot>
                </table>
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
                    <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $counter-1 }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="tab-pane fade text-start" id="add_user" role="tabpanel">
            <h3 class="pb-2">افزودن کاربر</h3>
            <div>
                <form method="post" action="{{route('addUser')}}" class="row flex-row-reverse justify-content-center">
                    @csrf
                    <div class="col-12 col-md-9 col-lg-4">
                        <label for="validationServer01" class="form-label">نام و نام خانوادگی</label>
                        <input type="text" class="form-control" id="validationServer01" name="full_name">
                    </div>
                    <div class="col-12 col-md-9 col-lg-4">
                        <label for="validationServer01" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" id="validationServer01" name="email">
                    </div>
                    <div class="col-12 col-md-9 col-lg-4">
                        <label for="validationServer01" class="form-label">شماره تماس</label>
                        <input type="text" class="form-control" id="validationServer01" name="phone_number">
                    </div>
                    <div class="col-12 col-md-9 col-lg-4 order-last order-lg-0">
                        <select id="validationServer01" dir="rtl" class="mt-lg-5" name="role_id">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->type }}</option>
                            @endforeach
                        </select>
                        <label for="validationServer01" class="form-label">نقش</label>
                        <input class="btn btn-outline-success mt-1 mt-lg-0" type="submit" value="افزودن">
                    </div>
                    <div class="col-12 col-md-9 col-lg-8">
                        <label for="validationServer01" class="form-label">توضیحات</label>
                        <textarea class="form-control" id="validationServer01" name="description"></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade text-start" id="v-pills-settings" role="tabpanel">
            <h3 class="pb-2">عنوان</h3>
            <div>متن...</div>
        </div>
    </div>
</div>
