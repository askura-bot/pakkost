<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('propertys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_properti');
            $table->longText('alamat');
            $table->enum('tipe', ['putra', 'putri', 'campur', 'kontrakan', 'kost']);
            $table->enum('sewa_jenis', ['bulanan', 'tahunan']);
            $table->integer('harga');
            $table->integer('jumlah_kamar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propertys');
    }
};
