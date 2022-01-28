<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Rule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $rule = array(
            array('penyakit_id' => 1,'gejala_id'=>1,'nilai_cf' => 0.2,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 1,'gejala_id'=>2,'nilai_cf' => 0.3,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 1,'gejala_id'=>3,'nilai_cf' => 0.6,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 1,'gejala_id'=>4,'nilai_cf' => 0.5,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 1,'gejala_id'=>5,'nilai_cf' => 0.1,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 1,'gejala_id'=>5,'nilai_cf' => 0.1,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 2,'gejala_id'=>1,'nilai_cf' => 0.2,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 2,'gejala_id'=>2,'nilai_cf' => 0.2,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 2,'gejala_id'=>3,'nilai_cf' => 0.3,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 3,'gejala_id'=>3,'nilai_cf' => 0.4,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 3,'gejala_id'=>3,'nilai_cf' => 0.2,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 3,'gejala_id'=>3,'nilai_cf' => 0.3,'created_at' => $date,'updated_at' => $date),
            array('penyakit_id' => 3,'gejala_id'=>3,'nilai_cf' => 0.2,'created_at' => $date,'updated_at' => $date),
        );
        Rule::insert($rule);
    }
}
