@extends('template')
@section('titre','edit')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier la photo</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $photo->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Modifier</button>
    </form>
</div>
@endsection