<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->bigInteger('harga');
            $table->decimal('jumlah', 10,2);
            $table->bigInteger('total_barang');
            $table->bigInteger('subtotal');
            $table->integer('diskon');
            $table->bigInteger('total');
            $table->bigInteger('modal');
            $table->bigInteger('laba');
            $table->bigInteger('bayar');
            $table->bigInteger('kembali');
            $table->integer('id_kasir');
            $table->string('kasir');
            $table->string('manual_transaksi')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
