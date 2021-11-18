<div class="container-fluid d-flex justify-content-center mt-5">
    <div class="row justify-content-center">

        @foreach($posts as $post)
            <div class="col-12 col-lg-10 border d-flex justify-content-center mt-5">
                <div class="card">
                    <img class="card-img-top" src="{{route('getImage',['post_id'=>$post->id])}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->user->full_name}}</h5>
                        <p class="card-text">{{$post->description}}</p>
                    </div>
                    <div class="card-body">
                        <a class="card-link comments" data-id="{{$post->id}}">نظرات</a>
                        @if(Auth::check())
                            <a class="card-link add-comment" data-id="{{$post->id}}">نظر بده</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
