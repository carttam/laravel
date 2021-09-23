<div class="modal fade" id="editUM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" dir="rtl">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">ویرایش کاربر</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-content">

                <form id="editUserForm" class="row g-3" method="post" action="{{route('editUser')}}">
                    @csrf
                    <input type="hidden" name="id">
                    @include('admin._partials.add_user_form')
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
