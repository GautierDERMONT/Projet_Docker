@extends('base')

@section('body')
<div class="container text-center">
    <p>Heure actuelle : <span id="current-time"></span></p>
    <div class="mb-3 d-flex justify-content-center">
        @foreach ($listeEpreuves as $index => $epreuvve)
            @if($epreuvve->statut == "en cours")
            <button class="btn btn-success mx-2" onclick="loadCouples({{ $epreuvve->id }})">
                <a href="{{ route('listing', ['idConcours' => $idConcours,'numListeEpreuve' => $index+1]) }}">{{ $epreuvve->titre }}</a>
            </button>
            @else
            <button class="btn btn-secondary mx-2" onclick="loadCouples({{ $epreuvve->id }})">
            <a href="{{ route('listing', ['idConcours' => $idConcours,'numListeEpreuve' => $index+1]) }}">{{ $epreuvve->titre }}</a>
            </button>
            @endif
        @endforeach
    </div>

    <h3 class="my-3"><strong>Club - Classement</strong></h3>

</div>

<table class="table table-striped table-bordered">
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
      <th scope="col">Classement</th>
    </tr>
  </thead>

<tbody>
@forelse($epreuve->couples as $couple)
    <tr>
      <th scope="row">{{ $couple->ordrePassage }}</th>
      <td>{{ $couple->cavalier }}</td>
      <td>{{ $couple->cheval }}</td>
      <td>{{ $couple->ecurie }}</td>
      <td>{{ $couple->coach }}</td>
      <td>{{ $couple->temps }}</td>
      <td>{{ $couple->penalite }}</td>
      <td>{{ $couple->temps_total }}</td>
      <td>{{ $couple->classement }}</td>
    </tr>
@empty
<tr>
  <th scope="row">aucun couple</th>
</tr>
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