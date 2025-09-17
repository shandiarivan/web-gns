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
        Schema::create('product_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique(); // 'gnet' atau 'martabe'
            $table->string('title');
            $table->string('tagline');
            $table->string('price_prefix')->default('Mulai dari');
            $table->string('price');
            $table->string('price_suffix')->default('/ bulan');
            $table->text('features'); // Fitur dipisah dengan baris baru
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_summaries');
    }
};
