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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('full_address');
            $table->string('phone');
            $table->string('prov_id');
            $table->string('city_id');
            $table->string('district_id');
            $table->string('postal_code');
            // User id
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // is_default
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
        // Menghapus kolom postal_code jika rollback migrasi
        // Schema::table('addresses', function (Blueprint $table) {
        //     $table->dropColumn('postal_code');
        // });
    }
};
