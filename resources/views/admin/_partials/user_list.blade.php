<h3 class="pb-2">لیست کاربران</h3>
<div class="table-responsive">
    @if($users->count() < $ft)
        <div class="alert alert-danger" dir="rtl">
            داده ای وجود ندارد.
        </div>
    @else
        <table class="table table-striped table-hover table-info fs-5 text-center">
            <thead>
            <tr>
                <th scope="col">-</th>
                <th scope="col">وضعیت</th>
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
                    <td><a href="{{route('removeUser',['id'=>$user->id])}}" class="text-danger"><i class="bi bi-x-circle"></i></a> <a class="edit-user" data-id="{{$user->id}}"><i class="bi bi-file-text"></i></a></td>
                    <td>{{ $user->status}}</td>
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
