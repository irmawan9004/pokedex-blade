@extends('pokemon.layout')

@section('content')

<h4 class="mt-5">Riwayat</h4>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<form action="">
<div class="input-group mb-3">
  <input name="search" type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
</div>
</form>

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Type ID</th>
        <th>Pokemon ID</th>
        <th>Nama Pokemon</th>
        <th>Spesies Pokemon</th>
        <th>Type Name</th>
        <th>Type Strength</th>
        <th>Type Weakness</th>
        <th>Breeding ID</th>
        <th>Breeding Egg cycle</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
              <td>{{ $data->type_id }}</td>
                <td>{{ $data->pokemon_id }}</td>
                <td>{{ $data->pokemon_name }}</td>
                <td>{{ $data->pokemon_species }}</td>
                <td>{{ $data->type_name }}</td>
                <td>{{ $data->type_strength }}</td>
                <td>{{ $data->type_weakness }}</td>
                <td>{{ $data->breeding_id }}</td>
                <td>{{ $data->egg_cycles }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop