@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-3">{{ $post->title }}</h2>
        <h5>{{ $post->slug }}</h5>
        <a class="btn btn-warning mt-3 mb-3" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
        <a class="btn btn-secondary ml-3" href="{{ route('admin.posts.index') }}">Elenco articoli</a>
        <p>{{$post->content}}</p>
    </div>

    <div class="m-3 d-flex justify-content-center">
        <a class="btn btn-primary" href="{{ route("admin.posts.index") }}">Torna alla lista</a>
    </div>
@endsection