@extends('base')

@section('body')
<div class="text-center mb-4">
    <h2>Liste des Concours</h2>
</div>

<table class="table table-striped table-bordered">
  <thead class="table-dark">
    <tr>
      <th scope="col" style="font-size: 1.5rem;">Numero</th>
      <th scope="col" style="font-size: 1.5rem;">Intitulé</th>
      <th scope="col" style="font-size: 1.5rem;">Type</th>
      <th scope="col" style="font-size: 1.5rem;">Date</th>
      @if(Auth::check() && (Auth::user()->role == 'jury' || Auth::user()->role == 'entrée de piste'))
    <th scope="col" style="font-size: 1.5rem;">Action</th>
  @endif
    </tr>
  </thead>
  <tbody>
    @forelse($listeConcours as $concours)
    <tr onclick="window.location='{{ route('showEpreuves', ['id' => $concours->id]) }}'" style="cursor: pointer;">
      <th scope="row">{{ $concours->numero }}</th>
      <td>{{ $concours->intitule }}</td>
      <td>{{ $concours->type }}</td>
      <td>{{ $concours->date }}</td>
      @if(Auth::check() && (Auth::user()->role=="jury" || Auth::user()->role=="entrée de piste"))
      <td>PARTICIPER</td>
      @endif
    </tr>
    @empty
    </tbody>
    </table>
    <h3>Aucun concours</h3>
    @endforelse
  </tbody>
</table>
@endsection