<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="{{ route('home') }}">ListingDepart</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto"> 
        @if(Auth::check())
          <li class="nav-item">
            <span class="navbar-text text-white me-3">{{ Auth::user()->role }}</span>
            <span class="navbar-text text-white me-3">{{ Auth::user()->nom }}</span>
          </li>
          <li class="nav-item">
            <span class="navbar-text text-white me-3"><a href="{{ route('logout') }}">Se déconnecter</a></span>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('loginFormulaire') }}">Se Connecter</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<br>
