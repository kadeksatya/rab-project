<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rabs', function (Blueprint $table) {
            $table->integer('kode_rab')->primary();
            $table->integer('kode_hps');
            $table->integer('kode_p');
            $table->text('nama_proyek');
            $table->date('tanggal_p');
            $table->text('volume');
            $table->text('jenis_p');
            $table->text('nama_p');
            $table->text('satuan_rab');
            $table->double('harga_satuan');
            $table->double('jumlah_harga');
            $table->double('biaya_jasak');
            $table->double('real_cost');
            $table->double('jml_dibulatkan');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rabs');
    }
}
