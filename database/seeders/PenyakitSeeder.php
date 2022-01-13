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
            array('name' => 'covid19','created_at' => $date,'updated_at' => $date),
            array('name' => 'influenza','created_at' => $date,'updated_at' => $date),
            array('name' => 'thypoid','created_at' => $date,'updated_at' => $date),
        );
        Penyakit::insert($penyakit);
    }
}
