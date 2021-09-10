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
    <select id="validationServer01" dir="rtl" class="mt-lg-5 mt-1" name="role_id">
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
