<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    
    
    public function index()
    {
        $kategori = Kategori::all();

        if($kategori->count() < 1){
            return response(
                [
                    "status" => "error",
                    "message" => "Data Kategori Kosong"
                ], 400);
        }

        return response()->json($kategori, 200);
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

        Kategori::create([
            "namaKategori" => $request->namaKategori
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Data Berhasil di Tambah"
        ], 200);
    }

    public function update(Request $request, Kategori $kategori){
        $validator = $this->__validate($request);

        if($validator->fails()){
            return response()->json([
                "status" => "error",
                "message" => "Error Validation",
                "validation" => $validator->errors()
            ], 400);
        }

        $kategori->update([
            "namaKategori" => $request->namaKategori
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Data Berhasil di Edit"
        ], 200);
    }

    public function destroy(Kategori $kategori){
        $kategori->delete();

        return response()->json([
            "status" => "success",
            "message" => "Data Berhasil di Hapus"
        ], 200);
    }

    private function __validate($request){
        $data = $request->all();
        $rules = [
            'namaKategori' => 'required|max:255',
        ];

        return Validator::make($data, $rules);
    }
}
