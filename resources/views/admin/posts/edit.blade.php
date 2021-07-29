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
            
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    <option value="">-- Seleziona una categoria --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ ($category->id == old('category_id', $post->category_id)) ? 'selected' : '' }}
                            >{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-5">
                <h5>Tags</h5>
                @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">
                        @if ($errors->any())
                            <input class="form-check-input" name="tags[]" type="checkbox"
                            id="tag-{{ $tag->id }}"
                            value="{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                        @else
                            <input class="form-check-input" name="tags[]" type="checkbox"
                            id="tag-{{ $tag->id }}"
                            value="{{ $tag->id }}"
                            {{ $post->tags->contains($tag->id) ? 'checked' : '' }}> 
                        @endif
                        
                        <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>     
                @endforeach 
                @error('tags')
                    <div>
                        <small class="text-danger">{{ $message }}</small> 
                    </div>
                @enderror   
            </div>    

            
            <button type="submit" class="btn btn-success">Salva</button>
            <a class="btn btn-secondary ml-3" href="{{ route("admin.posts.index") }}">Torna all'elenco post</a>
        </form>
    </div>

@endsection