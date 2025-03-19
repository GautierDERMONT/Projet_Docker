@extends('base')

@section('body')
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Ordre</th>
      <th scope="col">Statut</th>
    </tr>
  </thead>
  <tbody>
    @forelse($listeEpreuves as $epreuve)
    <tr onclick="window.location='{{ route('showCouples', ['id' => $epreuve->id]) }}'" style="cursor: pointer;">
      <th scope="row">{{ $epreuve->titre }}</th>
      <td>{{ $epreuve->ordre }}</td>
      <td>{{ $epreuve->statut }}</td>
    </tr>
    @empty
        <tr>
            <td colspan="3">Aucune epreuve disponible.</td>
        </tr>
    @endforelse
  </tbody>
</table>
@endsection