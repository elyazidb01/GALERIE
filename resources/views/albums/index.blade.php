@extends('template')
@section('titre','albums')

@section('content')
<div class="container">
    <h1 class="mb-4">Albums</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('albums.create') }}" class="btn btn-primary mb-3">Ajouter un album</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($albums as $album)
                <tr>
                    <td>{{ $album->id }}</td>
                    <td>{{ $album->titre }}</td>
                    <td>{{ $album->description }}</td>
                    <td>
                        <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet album ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun album disponible.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
