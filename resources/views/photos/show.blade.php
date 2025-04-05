@extends('template')
@section('titre','show')

@section('content')
<div class="container">
    <h1 class="mb-4">Détails de la photo</h1>

    <div class="card">
        <img src="{{ asset('storage/' . $photo->image) }}" class="card-img-top" alt="Photo">
        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text">{{ $photo->description }}</p>
            <a href="{{ route('photos.index') }}" class="btn btn-primary">Retour</a>
        </div>
    </div>
</div>
@endsection