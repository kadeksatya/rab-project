<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->integer('kode_hps')->primary();
            $table->integer('kode_bm');
            $table->integer('kode_alat');
            $table->integer('kode_p');
            $table->integer('kode_uk');
            $table->float('koefisien');
            $table->text('jenis_p');
            $table->text('nama_p');
            $table->text('nama_bahan');
            $table->text('pekerja');
            $table->text('jenis_alat');
            $table->text('satuan_hps');
            $table->double('hargas_bahan');
            $table->double('hargas_uk');
            $table->double('biaya_sewa');
            $table->double('harga_satuan');
            $table->softDeletes();


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
        Schema::dropIfExists('workers');
    }
}
