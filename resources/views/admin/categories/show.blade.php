@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>{{ $category->name }}</h2>

        <ol class="mt-4">
            @forelse ($category->posts as $post)
                <li>
                    <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
                </li>
            @empty
                <li>
                    <h2>Non ci sono ancora articoli in questa categoria!</h2>    
                </li>
            @endforelse
        </ol>
    </div>
    
@endsection