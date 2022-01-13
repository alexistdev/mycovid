<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyakit_id')->constrained('penyakits')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('gejala_id')->constrained('gejalas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->double('nilai_cf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rules');
    }
}
