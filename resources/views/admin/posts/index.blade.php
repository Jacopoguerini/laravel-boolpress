@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="my-3">Elenco Post</h3>

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th class="col-1">Id</th>
                    <th class="col-2">Titolo</th>
                    <th class="col-2">Slug</th>
                    <th colspan="3">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td class="text-capitalize">{{ $item->slug }}</td>
                        <td>
                            <a href="{{ route("admin.posts.show", $item->id) }}" class="btn btn-primary text-uppercase">
                                dettagli
                            </a>
                        </td>
                        <td>
                            <a href="" class="btn btn-warning text-uppercase">
                                modifica
                            </a>
                        </td>
                        <td>
                            <a href="" class="btn btn-danger text-uppercase">
                                elimina
                            </a>
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