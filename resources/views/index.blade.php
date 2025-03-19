@extends('base')

@section('body')
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Numero</th>
      <th scope="col">Intitulé</th>
      <th scope="col">Type</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    @forelse($listeConcours as $concours)
    <tr onclick="window.location='{{ route('showEpreuves', ['id' => $concours->id]) }}'" style="cursor: pointer;">
      <th scope="row">{{ $concours->numero }}</th>
      <td>{{ $concours->intitule }}</td>
      <td>{{ $concours->type }}</td>
      <td>{{ $concours->date }}</td>
    </tr>
    @empty
    <div>Aucun Concours</div>
    @endforelse
  </tbody>
</table>
@endsection