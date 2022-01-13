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
        );
        Rule::insert($rule);
    }
}
