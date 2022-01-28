<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use App\Models\Userinput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeteksiController extends Controller
{
    public function get_gejala(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak lengkap',
            ], 401);
        } else {
            $cekUser = Userinput::where('user_id',$request->id)->get();
            if($cekUser->count() != null){
                if($cekUser->count() != 5){
                    $gejala = Gejala::whereNotIn('id',function ($query){
                        $query->select('gejala_id')->from('userinputs');
                    })->first();
                    if($gejala != null){
                        return response()->json([
                            'status' => true,
                            'message' => 'pertanyaan berhasil diambil',
                            'gejala_id' => $gejala->id,
                            'gejala_name' => $gejala->name,
                            'selesai' => false,
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => true,
                            'message' => 'pertanyaan sudah selesai',
                            'selesai' => true,
                        ], 200);
                    }

                }else{
                    return response()->json([
                        'status' => true,
                        'message' => 'pertanyaan sudah selesai',
                        'selesai' => true,
                    ], 200);
                }
            } else {
                $gejala = Gejala::first();
                return response()->json([
                    'status' => true,
                    'message' => 'kosong',
                    'gejala_id' => $gejala->id,
                    'gejala_name' => $gejala->name,
                    'selesai' => false,
                ], 200);
            }

        }

    }

    public function simpan_jawaban(Request $request){
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'cf' => 'required',
            'gejala_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak lengkap',
            ], 401);
        } else {
            $jawaban = new Userinput();
            $jawaban->user_id = $request->id_user;
            $jawaban->gejala_id = $request->gejala_id;
            $jawaban->cf_user = $request->cf;
            $jawaban->save();
            return response()->json([
                'status' => true,
                'message' => 'Jawaban berhasil disimpan',
            ], 200);
        }
    }
}
