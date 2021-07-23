@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="my-4">Elenco Post</h3>

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titolo</th>
                    <th>Slug</th>
                    <th colspan="3">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>DETTAGLI</td>
                        <td>MODIFICA</td>
                        <td>ELIMINA</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection