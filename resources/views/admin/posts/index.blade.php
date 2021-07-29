@extends('layouts.app')

@section('content')
    <div class="container">

        <h3 class="my-3">Elenco Post</h3>
        <a href="{{ route("admin.posts.create") }}" class="btn btn-primary mb-3">Aggiungi post</a>

        @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }}
            </div>
        @endif

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th class="col-1">Id</th>
                    <th class="col-2">Titolo</th>
                    <th class="col-2">Slug</th>
                    <th class="col-1">Categoria</th>
                    <th class="col-2">Tags</th>
                    <th colspan="3">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td class="text-capitalize">{{ $item->slug }}</td>
                       
                        <td>{{ $item->category['name'] }}</td>

                        @if (count($item->tags) > 0)
                            <td>
                                @foreach ($item->tags as $tag)
                                    <span class="badge badge-pill badge-light">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                        @else
                            <td>
                                <span class="badge badge-pill badge-warning">Nessun Tag</span>
                            </td>
                        @endif
                        <td>
                            <a href="{{ route("admin.posts.show", $item->id) }}" class="btn btn-info text-uppercase">
                                dettagli
                            </a>
                        </td>
                        <td>
                            <a href="{{ route("admin.posts.edit", $item->id) }}" class="btn btn-warning text-uppercase">
                                modifica
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.posts.destroy', $item->id) }}" method="POST" onSubmit="return confirm('Sei sicuro di voler eliminare questo post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-uppercase">elimina</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
        

    </div>
@endsection