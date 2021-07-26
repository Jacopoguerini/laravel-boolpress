@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="container">
            <h2 class="my-4">Aggiungi un post</h2>
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title">Titolo</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Inserisci il titolo" name="title" value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Testo</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="6" name="content" placeholder="Inserisci il testo">{{ old('content') }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Aggiungi</button>
            </form>
        </div>

    </div>
@endsection