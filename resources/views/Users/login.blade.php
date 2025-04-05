@extends('template')
@section('titre', 'login')

@section('content')
<!-- Formulaire d'ajout -->
<form action="{{ route('auth.verifLogin') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de Passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>


    <button type="submit" class="btn btn-primary">S'authentifier</button>
</form>

<div class="row">
    <div class="col-12">
        @if (session('error_login'))
            <div class="alert alert-danger">
                {{ session('error_login') }}
            </div>


        @endif
    </div>

</div>

@endsection