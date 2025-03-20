@extends('base')

@section('body')
<div class="text-center mb-4">
    <h2>Liste des Épreuves</h2>
</div>

<table class="table table-striped table-bordered">
  <thead class="table-dark">
    <tr>
      <th scope="col" style="font-size: 1.5rem;">Titre</th>
      <th scope="col" style="font-size: 1.5rem;">Ordre</th>
      <th scope="col" style="font-size: 1.5rem;">Statut</th>
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
            <td colspan="3">Aucune épreuve disponible.</td>
        </tr>
    @endforelse
  </tbody>
</table>
@endsection