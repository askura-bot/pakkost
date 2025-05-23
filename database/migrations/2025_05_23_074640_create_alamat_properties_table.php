<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alamat_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('propertys')->onDelete('cascade');
            $table->string('kelurahan', 100);
            $table->string('jalan', 255);
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alamat_properties');
    }
};

