<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Daftarvaksin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Vaksin extends Controller
{
    public function pendaftaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'nama_lengkap' => 'required|max:255',
            'nik' => 'required|max:255',
            'phone' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak lengkap',
            ], 401);
        } else {
            $user = new Daftarvaksin();
            $user->user_id = $request->user_id;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->nik = $request->nik;
            $user->phone = $request->phone;
            $user->save();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
            ], 200);
        }
    }

    public function listvaksin(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak lengkap',
            ], 401);
        } else {
            $vaksin = Daftarvaksin::where('user_id',$request->user_id)->get();
            if(!$vaksin->isEmpty()){
                return response()->json([
                    'status' => false,
                    'message' => 'Data berhasil didapatkan',
                    'result' => $vaksin,
                ], 200);
            } else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data kosong',
                ], 404);
            }
        }
    }
}
