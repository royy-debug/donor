<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->enum('gender', ['M', 'F', 'male', 'female']);
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->string('phone')->default(0);
            $table->string('address')->default('Unknown');
            $table->integer('required_blood_bags')->default(1);
            $table->string('status')->default('waiting'); // waiting, fulfilled, canceled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipients');
    }
};
