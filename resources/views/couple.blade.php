@extends('base')

@section('body')
<div class="text-center mb-4">
    <h2>LISTE DES COUPLES</h2>
</div>

<table class="table table-striped table-bordered">
  <thead class="table-dark">
    <tr>
      <th scope="col" style="font-size: 1.5rem;">Ordre de passage</th>
      <th scope="col" style="font-size: 1.5rem;">Cavalier</th>
      <th scope="col" style="font-size: 1.5rem;">Cheval</th>
      <th scope="col" style="font-size: 1.5rem;">Écurie</th>
      <th scope="col" style="font-size: 1.5rem;">Coach</th>
      <th scope="col" style="font-size: 1.5rem;">Temps</th>
      <th scope="col" style="font-size: 1.5rem;">Pénalité</th>
      <th scope="col" style="font-size: 1.5rem;">Temps Total</th>
      <th scope="col" style="font-size: 1.5rem;">Classement</th>
    </tr>
  </thead>
  <tbody>
    @forelse($listeCouples as $couple)
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
            <td colspan="9">Aucun couple.</td>
        </tr>
    @endforelse
  </tbody>
</table>
@endsection
