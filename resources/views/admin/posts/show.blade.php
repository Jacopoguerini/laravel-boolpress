@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column">
        <h3 class="my-3">{{ $post->title }}</h3>
        <p>{{$post->content}}</p>
    </div>

    <div class="m-3 d-flex justify-content-center">
        <a class="btn btn-primary" href="{{ route("admin.posts.index") }}">Torna alla lista</a>
    </div>
@endsection