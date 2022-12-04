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

        <h5 class="card-title fw-bolder mb-3">Tambah Type</h5>

		<form method="post" action="{{ route('type.store') }}">
			@csrf
            <div class="mb-3">
                <label for="type_id" class="form-label">ID Type</label>
                <input type="text" class="form-control" id="type_id" name="type_id">
            </div>
			<div class="mb-3">
                <label for="type_name" class="form-label">type_name</label>
                <input type="text" class="form-control" id="type_name" name="type_name">
            </div>
            <div class="mb-3">
                <label for="type_strength" class="form-label">type_strength</label>
                <input type="text" class="form-control" id="type_strength" name="type_strength">
            </div>
            <div class="mb-3">
                <label for="type_weakness" class="form-label">type_weakness</label>
                <input type="text" class="form-control" id="type_weakness" name="type_weakness">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop