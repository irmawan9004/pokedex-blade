@extends('pokemon.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Tambah pokemon</h5>

		<form method="post" action="{{ route('pokemon.store') }}">
			@csrf
            <div class="mb-3">
                <label for="pokemon_id" class="form-label">Pokemon ID</label>
                <input type="text" class="form-control" id="pokemon_id" name="pokemon_id">
            </div>
			<div class="mb-3">
                <label for="pokemon_name" class="form-label">pokemon_name</label>
                <input type="text" class="form-control" id="pokemon_name" name="pokemon_name">
            </div>
            <div class="mb-3">
                <label for="pokemon_species" class="form-label">pokemon_species</label>
                <input type="text" class="form-control" id="pokemon_species" name="pokemon_species">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop