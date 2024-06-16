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
        Schema::create('waste_exchanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('recycling_center_id')->constrained()->onDelete('cascade');
            $table->foreignId('waste_type_id')->constrained()->onDelete('cascade');
            $table->decimal('weight', 8, 2); // berat sampah dalam gram
            $table->decimal('points', 8, 2); // poin yang diterima
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_exchanges');
    }
};
