@extends('base')

@section('body')
<div class="container text-center">
@if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif
    <p>Heure actuelle : <span id="current-time"></span></p>
    <div class="mb-3 d-flex justify-content-center">
        @foreach ($listeEpreuves as $index => $epreuvve)
            @if($epreuvve->statut == "en cours")
            <button class="btn btn-success mx-2" onclick="loadCouples({{ $epreuvve->id }})">
            @elseif($epreuvve->statut == "terminee" || $epreuvve->statut == "cloture")
            <button class="btn btn-danger mx-2" onclick="loadCouples({{ $epreuvve->id }})">
            @else
            <button class="btn btn-secondary mx-2" onclick="loadCouples({{ $epreuvve->id }})">
            @endif    
            <a href="{{ route('listing', ['idConcours' => $idConcours,'numListeEpreuve' => $index+1]) }}" class="text-decoration-none text-dark">{{ $epreuvve->titre }}({{ $epreuvve->ordre }})</a>
            </button>
        @endforeach
    </div>
    <a href="{{ route('showEpreuves', ['id' => $idConcours] )}}" class="text-decoration-none text-dark"><button type="button" class="btn btn-primary">Détails sur les épreuves</button></a>
    <h3 class="my-3"><strong>Club - Classement</strong></h3>
    @if($epreuve->statut =="à venir" && Auth::check() && Auth::user()->role=="jury")
      <h4><a href="{{ route('commencerEpreuve', ['idEpreuve' => $epreuve->id] )}}" class="text-decoration-none text-dark"><button type="button" class="btn btn-dark">Commencer</button></a></h4>
    @elseif($epreuve->statut =="en cours" && Auth::check() && Auth::user()->role=="jury")
      <h4><a href="{{ route('terminerEpreuve', ['idEpreuve' => $epreuve->id] )}}" class="text-decoration-none text-dark"><button type="button" class="btn btn-dark">Terminer</button></a></h4>
    @elseif($epreuve->statut =="terminee" && Auth::check() && Auth::user()->role=="jury")
      <h4><a href="{{ route('cloturerEpreuve', ['idEpreuve' => $epreuve->id] )}}" class="text-decoration-none text-dark"><button type="button" class="btn btn-dark">Clôturer</button></a></a></h4>
    @else
      <h4>{{ $epreuve->statut }}</h4>
    @endif
</div>

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th scope="col">Ordre de passage</th>
      <th scope="col">Cavalier</th>
      <th scope="col">Cheval</th>
      <th scope="col">Écurie</th>
      <th scope="col">Coach</th>
      <th scope="col">Temps</th>
      <th scope="col">Pénalité</th>
      <th scope="col">Temps Total</th>
      @if($epreuve->statut =="cloture")
      <th scope="col">Classement</th>
      @else
      <th scope="col">Classement (provisoire)</th>
      @endif
       
      @if(Auth::check() && $epreuve->statut =="en cours" || (Auth::check() && Auth::user()->role=="jury" && ($epreuve->statut =="en cours" || $epreuve->statut =="à venir"))) 
      <th scope="col">Action</th>
      @endif
      @if($epreuve->statut =="en cours" && Auth::check() && Auth::user()->role=="jury")
      <th scope="col">Actions invalidant le couple</th>
      @endif
    </tr>
  </thead>

<tbody>
@forelse($listeCouples as $couple)
<tr>
      <th scope="row">{{ $couple->ordrePassage }}</th>
      @if (Auth::check() && Auth::user()->role=="jury" && ($epreuve->statut=="en cours" || $epreuve->statut=="à venir"))
      <td><a href="{{ route('modifierCouple', ['idCouple' => $couple->id]) }}">{{ $couple->cavalier }}</a></td>
      <td><a href="{{ route('modifierCouple', ['idCouple' => $couple->id]) }}">{{ $couple->cheval }}</a></td>
      
      @else
      <td>{{ $couple->cavalier }}</td>
      <td>{{ $couple->cheval }}</td>
      @endif
      
      <td>{{ $couple->ecurie }}</td>
      <td>{{ $couple->coach }}</td>
      @if($epreuve->statut =="en cours" && Auth::check() && Auth::user()->role=="jury" && $couple->classement == "en piste")
      <form action="{{ route('notifierFini', ['idCouple' => $couple->id]) }}" method="POST">
        @csrf
        <td>
          <input type="time" name="temps" step="1" class="form-control" required>
        </td>
        <td>
          <input type="number" name="penalite" class="form-control" required>
        </td>
        <td>{{ $couple->temps_total }}</td>
        <td>{{ $couple->classement }}</td>
        <td>
          <button type="submit" class="btn btn-primary">Fini</button>
        </td>
      </form>
      @else
        <td>{{ $couple->temps }}</td>
        <td>{{ $couple->penalite }}</td>
        <td>{{ $couple->temps_total }}</td>
        <td>{{ $couple->classement }}</td>

        @if($epreuve->statut =="en cours" && Auth::check() && $couple->classement == "partant")
        <td><a href="{{ route('notifierBordPiste', ['idCouple' => $couple->id]) }}" class="text-decoration-none text-dark"><button type="button" class="btn btn-primary">Est en bord de Piste</button></a></td>
        @elseif($epreuve->statut =="en cours" && Auth::check())
          @if ($couple->classement == "en bord de piste")
            <td><a href="{{ route('notifierEnPiste', ['idCouple' => $couple->id]) }}" class="text-decoration-none text-dark"><button type="button" class="btn btn-primary">En Piste</button></a></td>
            {{-- @elseif($couple->classement == "en piste")
            <td><a href="{{ route('notifierFini', ['idCouple' => $couple->id]) }}" class="text-decoration-none text-dark"><button type="button" class="btn btn-primary">Fini</button></a></td>
          --}}@endif
        @endif
      @endif

      @if($epreuve->statut =="en cours" && Auth::check() && Auth::user()->role=="jury")
      <th scope="col">
        <a href="{{ route('notifierElimine', ['idCouple' => $couple->id]) }}" class="text-decoration-none text-dark"><button class="btn btn-warning">Eliminé</button></a>
        <a href="{{ route('notifierNonPartant', ['idCouple' => $couple->id]) }}" class="text-decoration-none text-dark"><button type="button" class="btn btn-danger">Non Partant </button></a>
      </th>
      @endif
    </tr>
@empty

@endforelse
</tbody>
<tbody>
@forelse($listeCouplesFini as $coupleFini)
  @if($coupleFini->classement=="non partant")
    <tr class="table-danger">
  @elseif($coupleFini->classement=="elimine")
    <tr class="table-warning">
  @else
    <tr class="table-success">
  @endif
  <th scope="col">{{ $coupleFini->ordrePassage }}</th>
  <td>{{ $coupleFini->cavalier }}</td>
  <td>{{ $coupleFini->cheval }}</td>
  <td>{{ $coupleFini->coach }}</td>
  <td>{{ $coupleFini->ecurie }}</td>
  <td>{{ $coupleFini->temps }}</td>
  <td>{{ $coupleFini->penalite }}</td>
  <td>{{ $coupleFini->temps_total }}</td>
  <td>{{ $coupleFini->classement }}</td>
  @if($epreuve->statut=="en cours")
  <td></td>
  <td></td>
  @endif
</tr>
@empty

@endforelse
</tbody>
</table>
<script>
    function updateTime() {
        const now = new Date();
        document.getElementById("current-time").innerText = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000);
    updateTime();
</script>
@endsection