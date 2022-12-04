<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembeliController extends Controller
{
    public function index()
    {
        $datas = DB::select('select * from type');

        return view('type.index')
            ->with('datas', $datas);
    }

    public function create()
    {
        return view('type.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'type_name' => 'required',
            'type_strength' => 'required',
            'type_weakness' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO type(type_id, type_name, type_strength, type_weakness) VALUES (:type_id, :type_name, :type_strength, :type_weakness)',
            [
                'type_id' => $request->type_id,
                'type_name' => $request->type_name,
                'type_strength' => $request->type_strength,
                'type_weakness' => $request->type_weakness,
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

        return redirect()->route('type.index')->with('success', 'Data type berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::table('type')->where('type_id', $id)->first();

        return view('type.edit')->with('data', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'type_name' => 'required',
            'type_strength' => 'required',
            'type_weakness' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE type SET type_id = :type_id, type_name = :type_name, type_strength = :type_strength, type_weakness = :type_weakness WHERE type_id = :id',
            [
                'id' => $id,
                'type_id' => $request->type_id,
                'type_name' => $request->type_name,
                'type_strength' => $request->type_strength,
                'type_weakness' => $request->type_weakness,
            ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'type_strength' => $request->type_strength,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('type.index')->with('success', 'Data type berhasil diubah');
    }

    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM type WHERE type_id = :type_id', ['type_id' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('type_id', $id)->delete();

        return redirect()->route('type.index')->with('success', 'Data Admin berhasil dihapus');
    }
}
