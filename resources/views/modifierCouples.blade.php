@extends('base')

@section('body')
<form action="{{ route('modifierCoupleSave', ['idCouple' => $couple->id]) }}" method="POST" class="p-4 border rounded shadow bg-white">
    @csrf

    <div class="mb-3">
        <label for="cavalier" class="form-label">Nom du Cavalier :</label>
        <input type="text" id="cavalier" name="cavalier" class="form-control" value="{{$couple->cavalier ?? 'Nom du Cavalier'}}" required>
    </div>

    <div class="mb-3">
        <label for="cheval" class="form-label">Nom du Cheval :</label>
        <input type="text" id="cheval" name="cheval" class="form-control" value="{{$couple->cheval ?? 'Nom du Cheval'}}" required>
    </div>

    @if ($couple->classement=="partant" || $couple->classement=="en bord de piste")
        <div class="form-group">
            <label for="listeEpreuves">Changer d'épreuve :</label>
            <select class="form-control" id="listeEpreuves" name="idEpreuve">
            @foreach ($allEpreuves as $epreuve)
                <option value="{{ $epreuve->id }}" 
                    {{ isset($epreuveDuCouple) && $epreuveDuCouple->id == $epreuve->id ? 'selected' : '' }}>
                    {{ $epreuve->titre }} (id : {{ $epreuve->id }})
                </option>
            @endforeach
            </select>
        </div>
    @endif
    <br><br>

    <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
</form>
@endsection