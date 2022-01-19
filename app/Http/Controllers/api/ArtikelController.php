<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::all();

        if($artikel->count() < 1){
            return response(
                [
                    "status" => "error",
                    "message" => "Data Artikel Kosong"
                ], 400);
        }

        return response()->json($artikel, 200);
    }

    
    public function store(Request $request){
        $validator = $this->__validate($request);

        if($validator->fails()){
            return response()->json([
                "status" => "error",
                "message" => "Error Validation",
                "validation" => $validator->errors()
            ], 400);
        }

        Artikel::create([
            "judul" => $request->judul,
            "isi" => $request->isi,
            "tanggal" => $request->tanggal,
            "id_kategori" => $request->id_kategori,
            "id_admin" => $request->id_admin,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Data Berhasil di Tambah"
        ], 200);
    }

    public function update(Request $request, Artikel $artikel){
        $validator = $this->__validate($request);

        if($validator->fails()){
            return response()->json([
                "status" => "error",
                "message" => "Error Validation",
                "validation" => $validator->errors()
            ], 400);
        }

        $artikel->update([
            "judul" => $request->judul,
            "isi" => $request->isi,
            "tanggal" => $request->tanggal,
            "id_kategori" => $request->id_kategori,
            "id_admin" => $request->id_admin,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Data Berhasil di Edit"
        ], 200);
    }

    public function destroy(Artikel $artikel){
        $artikel->delete();

        return response()->json([
            "status" => "success",
            "message" => "Data Berhasil di Hapus"
        ], 200);
    }

    private function __validate($request){
        $data = $request->all();
        $rules = [
            'judul' => 'required',
            'isi' => 'required',
            'tanggal' => 'required',
            'id_kategori' => 'required',
            'id_admin' => 'required',
        
        ];

        return Validator::make($data, $rules);
    }
}
