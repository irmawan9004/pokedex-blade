<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $datas = DB::select('select * from pokemon WHERE pokemon_name like :search AND recycle=0', [
                'search' => '%' . $request->search . '%',
            ]);

            $datasrecycle = DB::select('select * from pokemon WHERE pokemon_name like :search AND recycle=1', [
                'search' => '%' . $request->search . '%',
            ]);

            return view('pokemon.index')
                ->with('datas', $datas)
                ->with('datasrecycle', $datasrecycle);
        } else {
            $datas = DB::select('select * from pokemon WHERE recycle=0');
            $datasrecycle = DB::select('select * from pokemon WHERE recycle=1');

            return view('pokemon.index')
                ->with('datas', $datas)
                ->with('datasrecycle', $datasrecycle);
        }
    }
    public function join(Request $request)
    {
        if ($request->has('search')) {
            $datas = DB::select('SELECT type.type_id,pokemon.pokemon_id,pokemon.pokemon_name,pokemon.pokemon_species,type.type_name,type.type_strength,type.type_weakness,breeding.breeding_id,breeding.egg_cycles FROM `pokemon` LEFT JOIN type ON type.type_id = pokemon.type_id LEFT JOIN breeding on breeding.breeding_id = pokemon.breeding_id WHERE pokemon.pokemon_name like :search', [
                'search' => '%' . $request->search . '%',
            ]);

            return view('join')
                ->with('datas', $datas);
        } else {
            $datas = DB::select('SELECT type.type_id,pokemon.pokemon_id,pokemon.pokemon_name,pokemon.pokemon_species,type.type_name,type.type_strength,type.type_weakness,breeding.breeding_id,breeding.egg_cycles FROM `pokemon` LEFT JOIN type ON type.type_id = pokemon.type_id LEFT JOIN breeding on breeding.breeding_id = pokemon.breeding_id');

            return view('join')
                ->with('datas', $datas);
        }
    }
    public function create()
    {
        return view('pokemon.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pokemon_id' => 'required',
            'pokemon_name' => 'required',
            'pokemon_species' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO pokemon(pokemon_id, pokemon_name, pokemon_species) VALUES (:pokemon_id, :pokemon_name, :pokemon_species)',
            [
                'pokemon_id' => $request->pokemon_id,
                'pokemon_name' => $request->pokemon_name,
                'pokemon_species' => $request->pokemon_species,
            ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('pokemon.index')->with('success', 'Data pokemon berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::table('pokemon')->where('pokemon_id', $id)->first();

        return view('pokemon.edit')->with('data', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'pokemon_id' => 'required',
            'pokemon_name' => 'required',
            'pokemon_species' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE pokemon SET pokemon_id = :pokemon_id, pokemon_name = :pokemon_name, pokemon_species = :pokemon_species WHERE pokemon_id = :id',
            [
                'id' => $id,
                'pokemon_id' => $request->pokemon_id,
                'pokemon_name' => $request->pokemon_name,
                'pokemon_species' => $request->pokemon_species,
            ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'pokemon_species' => $request->pokemon_species,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('pokemon.index')->with('success', 'Data pokemon berhasil diubah');
    }

    public function delete($id)
    {
        DB::delete('DELETE FROM pokemon WHERE pokemon_id = :pokemon_id', ['pokemon_id' => $id]);
        return redirect()->route('pokemon.index')->with('success', 'Data Admin berhasil dihapus');
    }
    public function recycle($id)
    {
        DB::update('UPDATE pokemon set recycle = 1 WHERE pokemon_id = :pokemon_id', ['pokemon_id' => $id]);
        return redirect()->route('pokemon.index')->with('success', 'Data Admin berhasil dihapus');
    }
    public function restore($id)
    {
        DB::update('UPDATE pokemon set recycle = 0 WHERE pokemon_id = :pokemon_id', ['pokemon_id' => $id]);
        return redirect()->route('pokemon.index')->with('success', 'Data Admin berhasil dihapus');
    }
}
