@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="my-4">Aggiungi un post</h2>
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Inserisci il titolo" name="title" value="{{ old('title') }}">
                @error('title')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Testo</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="6" name="content" placeholder="Inserisci il testo">{{ old('content') }}</textarea>
                @error('content')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>

                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">

                    <option value="">Seleziona una categoria</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                        {{ ($category->id == old('category_id')) ? 'selected' : '' }}>
                                {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>

            {{-- upload image --}}
            <div class="form-group">
                <label for="cover">immagine del post</label>
                <input type="file" name="cover" class="form-control-file @error('cover') is-invalid @enderror" id="cover">
                @error('cover')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- /upload image --}}

            {{-- tags --}}
            <div class="form-group mb-3">
                <h6>Tag</h6>
                @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="tags[]" type="checkbox"
                        id="tag-{{ $tag->id }}"
                        value="{{ $tag->id }}"
                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>

                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>     
                @endforeach 
                @error('tags')
                    <div>
                        <small class="text-danger">{{ $message }}</small> 
                    </div>
                @enderror   
            </div>
            {{-- /tags --}}
            
            <button type="submit" class="btn btn-success">Aggiungi</button>
            <a class="btn btn-secondary ml-3" href="{{ route("admin.posts.index") }}">Torna all'elenco post</a>
        </form>
    </div>
    
@endsection