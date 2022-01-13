<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $penyakit = array(
            array('kode'=> 'P01','name' => 'covid19','created_at' => $date,'updated_at' => $date),
            array('kode'=> 'P02','name' => 'influenza','created_at' => $date,'updated_at' => $date),
            array('kode'=> 'P03','name' => 'thypoid','created_at' => $date,'updated_at' => $date),
        );
        Penyakit::insert($penyakit);
    }
}
