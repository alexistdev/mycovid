<?php

namespace App\CF;


use App\Models\Rule;
use App\Models\Userinput;

class TestInputData
{
    public function testinput()
    {
//        $arr = [];
//
//        $dataModel = Userinput::with('gejala')
//            ->orderBy('gejala_id', 'ASC')
//            ->get();
//        $i= 0;
//        foreach($dataModel as $row){
//            $arr[$i]['kode_rule'] = $row->gejala->kode;
//            $arr[$i]['persentase_user'] = $row->cf_user;
//            $i++;
//        }


        $arr[0]['kode_rule'] = "G01";
        $arr[0]['persentase_user'] = 0.8;
//
        $arr[1]['kode_rule'] = "G02";
        $arr[1]['persentase_user'] = 0.4;
//
        $arr[2]['kode_rule'] = "G03";
        $arr[2]['persentase_user'] = 0.1;

        $arr[3]['kode_rule'] = "G04";
        $arr[3]['persentase_user'] = 0.4;

        $arr[4]['kode_rule'] = "G05";
        $arr[4]['persentase_user'] = 0.1;

        return $arr;
        // echo json_encode($arr);
    }
}
