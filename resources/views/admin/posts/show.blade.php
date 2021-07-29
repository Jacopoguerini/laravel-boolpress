@extends('layouts.app')

@section('content')

    <div class="container">
        
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <h2 class="my-3">{{ $post->title }}</h2>
        <h5>{{ $post->slug }}</h5>
        
        <h4 class="mb-3">Categoria:
            <a href="{{ route('admin.categories.show', $post->category->id)}}" class="badge badge-info">
                {{ $post->category->name }}
            </a>
        </h4>

        @if (count($post->tags) > 0)
            <div class="h5 mb-3">
                <span>Tag:</span>
                @foreach ($post->tags as $tag)
                    <span class="badge badge-pill badge-dark">{{ $tag->name }}</span>    
                @endforeach
            </div>
        @else
            <h6 class="mt-3 mb-2">Nessun tag associato</h6>    
        @endif

        <div class="d-flex align-items-center mt-2 mb-2">
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onSubmit="return confirm('Sei sicuro di voler cancellare definitivamente {{ $post->title }}?')">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger ml-3" value="ELIMINA">
            </form>
        </div>

        <p>{{$post->content}}</p>
    </div>

    <div class="m-3 d-flex justify-content-center">
        <a class="btn btn-secondary" href="{{ route("admin.posts.index") }}">Torna all'elenco post</a>
    </div>

@endsection