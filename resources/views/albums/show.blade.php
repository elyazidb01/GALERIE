@extends('template')
@section('titre','show')

@section('content')
<div class="container">
    <h1 class="mb-4">Détails de l'album</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Titre</h5>
            <p class="card-text">{{ $album->titre }}</p>

            <h5 class="card-title">Description</h5>
            <p class="card-text">{{ $album->description }}</p>

            <a href="{{ route('albums.index') }}" class="btn btn-primary">Retour</a>
        </div>
    </div>
</div>
@endsection

