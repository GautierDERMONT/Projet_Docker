@extends('base')

@section('body')
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Ordre de passage</th>
      <th scope="col">Cavalier</th>
      <th scope="col">Cheval</th>
      <th scope="col">Ecurie</th>
      <th scope="col">Coach</th>
      <th scope="col">Temps</th>
      <th scope="col">Pénalité</th>
      <th scope="col">Temps Total</th>
      <th scope="col">Classement</th>
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
            <td colspan="3">Aucun couples.</td>
        </tr>
    @endforelse
  </tbody>
</table>
@endsection