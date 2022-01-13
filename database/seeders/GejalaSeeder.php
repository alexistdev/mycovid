<?php

namespace Database\Seeders;

use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $gejala = array(
            array('kode'=> 'G01','name' => 'terasa lemas di seluruh tubuh','created_at' => $date,'updated_at' => $date),
            array('kode'=> 'G02','name' => 'merasakan sakit kepala','created_at' => $date,'updated_at' => $date),
            array('kode'=> 'G03','name' => 'nyeri pada dada','created_at' => $date,'updated_at' => $date),
            array('kode'=> 'G04','name' => 'demam','created_at' => $date,'updated_at' => $date),
            array('kode'=> 'G05','name' => 'kaki dan tangan terasa dingin','created_at' => $date,'updated_at' => $date),
        );
        Gejala::insert($gejala);
    }
}
