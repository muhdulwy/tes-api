<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();

        if($admin->count() < 1){
            return response(
                [
                    "status" => "error",
                    "message" => "Data Admin Kosong"
                ], 400);
        }

        return response()->json($admin, 200);
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

        Admin::create([
            "name" => $request->name,
            "username" => $request->username,
            "password" => $request->password
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Data Berhasil di Tambah"
        ], 200);
    }

    public function update(Request $request, Admin $admin){
        $validator = $this->__validate($request);

        if($validator->fails()){
            return response()->json([
                "status" => "error",
                "message" => "Error Validation",
                "validation" => $validator->errors()
            ], 400);
        }

        $admin->update([
            "name" => $request->name,
            "username" => $request->username,
            "password" => $request->password
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Data Berhasil di Edit"
        ], 200);
    }

    public function destroy(Admin $admin){
        $admin->delete();

        return response()->json([
            "status" => "success",
            "message" => "Data Berhasil di Hapus"
        ], 200);
    }

    private function __validate($request){
        $data = $request->all();
        $rules = [
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'password' => 'required|min:8',
        ];

        return Validator::make($data, $rules);
    }
}
