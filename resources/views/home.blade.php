@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard | <a href="/post/create">New Post</a> </div>

                <div class="card-body">

                    @if (session('lastActivityTime'))
                        {{ session('lastActivityTime') }}
                    @endif
                        <div class="container">
                            @foreach($posts as $post)
                                <p><a href='{{url("post/{$post->id}")}}'> {{$post->title}}</a></p>
                                <small>
                                    @foreach($post->tags as $tag)
                                        {{$tag->name}},
                                    @endforeach
                                </small>
                            @endforeach
                        </div>

                        {{ $posts->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
