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
    @foreach($listeConcours as $concours)
    <tr>
      <th scope="row">{{ $concours->numero }}</th>
      <td>{{ $concours->intitule }}</td>
      <td>{{ $concours->type }}</td>
      <td>{{ $concours->date }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection