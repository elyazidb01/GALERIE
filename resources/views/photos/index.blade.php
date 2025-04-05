@extends('../template')

@section('titre', "Liste des photos")



@section('content')
<div class="container">
    <h1 class="mb-4">Photos</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('photos.create') }}" class="btn btn-primary mb-3">Ajouter une photo</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($photos as $photo)
                <tr>
                    <td>{{ $photo->id }}</td>
                    <td><img src="{{ asset('storage/' . $photo -> image) }}" alt="Photo de {{$photo->description}}" width="50"></td>
                    <td>{{ $photo->description }}</td>
                    <td>
                        <a href="{{ route('photos.show', $photo->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette photo ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucune photo disponible.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection