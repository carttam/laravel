<h3 class="pb-2">لیست نقش ها</h3>
<div>
    <table class="table table-striped table-hover table-info text-center">
        <thead>
        <tr>
            <th scope="col">-</th>
            <th scope="col">سطح</th>
            <th scope="col">نقش</th>
            <th scope="col">#</th>
        </tr>
        </thead>
        <tbody>
        <?php $counter = 1; ?>
        @foreach($roles as $role)
            <tr>
                <td><a data-href="{{route('removeRole',['id'=>$role->id])}}" class="text-danger remove-role"><i class="bi bi-x-circle"></i></a></td>
                <td>{{ $role->level }}</td>
                <td>{{ $role->type }}</td>
                <td>{{ $counter }}</td>
            </tr>
            <?php $counter++; ?>
        @endforeach
        </tbody>
    </table>
</div>
