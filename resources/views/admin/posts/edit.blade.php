@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="my-4">Modifica il post: <span class="text-info">{{ $post->title }}</span></h2>
        
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Inserisci il titolo" name="title" value="{{ old('title', $post->title) }}">
                @error('title')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Testo</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="6" name="content" placeholder="Inserisci il testo">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Salva</button>
        </form>
    </div>

@endsection