<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color:#1d033c;">
    <a class="navbar-brand" href="/">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Inscription
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('auth.create')}}">S'inscrire</a>
            </div>
        </li>
        <li class="nav-item">
            @if (!session('authentification'))
            <a class="nav-link" href="{{route('auth.login')}}">Se connecter</a>
            
            @endif
            @if (session('authentification'))
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-sign-out"></i>
                        </button>
                    </form>

                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('photos.index')}}">Liste des photos <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('albums.index')}}">Liste des albums</a>
                </li>
            @endif
        </ul>
        
    </div>
</nav>

</body>
</html>
