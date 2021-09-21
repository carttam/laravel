<div class="modal fade" id="addCM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">پست</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-content">

                <form class="row g-3" method="post" action="{{route('addComment')}}">
                    @csrf
                    <div class="col-12 mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label"></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
                    </div>
                    <input type="hidden" id="addCM-id" name="id">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">نظر دهید</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
