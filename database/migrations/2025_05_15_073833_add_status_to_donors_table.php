<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('donors', function (Blueprint $table) {
            $table->enum('status', ['pending','approved','rejected'])
                  ->default('pending')
                  ->after('blood_count');
        });
    }

    public function down()
    {
        Schema::table('donors', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
