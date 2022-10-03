<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_details', function (Blueprint $table) {
            $table->id();
            $table->float('koefisien');
            $table->integer('kode_hps');
            $table->integer('kode_bm')->nullable();
            $table->integer('kode_alat')->nullable();
            $table->integer('kode_p')->nullable();
            $table->integer('kode_uk')->nullable();
            $table->double('harga_satuan')->nullable();
            $table->double('satuan')->nullable();
            $table->double('harga')->nullable();
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
        Schema::dropIfExists('worker_details');
    }
}
