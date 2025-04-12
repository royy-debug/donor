<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16);
            $table->string('name');
            $table->enum('gender', ['M', 'F']);
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->decimal('blood_count', 8, 2)->default(0); // jumlah darah yang didonorkan
            $table->string('phone');
            $table->string('email');
            $table->integer('weight')->nullable();
            
            // Pre-screening
            $table->boolean('is_healthy')->default(false);
            $table->boolean('has_disease_history')->default(false); // baru tambahkan biar konsisten
            $table->boolean('slept_well')->default(false); // baru tambahkan juga
            $table->boolean('has_donated_recently')->default(false);


            // Upload berkas
            $table->string('ktp_file')->nullable();
            
            // QR Code file path
            $table->string('qr_code')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
