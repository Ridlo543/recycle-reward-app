<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('waste_exchanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('recycling_center_id')->constrained()->onDelete('cascade');
            $table->foreignId('waste_type_id')->constrained()->onDelete('cascade');
            $table->decimal('weight', 8, 2);
            $table->decimal('points', 8, 2);
            $table->string('image')->default('images/waste.jpg')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->enum('status', [
                \App\Enums\WasteExchangeStatus::Processing->value,
                \App\Enums\WasteExchangeStatus::Picked->value,
                \App\Enums\WasteExchangeStatus::Accepted->value,
                \App\Enums\WasteExchangeStatus::Cancelled->value,
            ])->default(\App\Enums\WasteExchangeStatus::Processing->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waste_exchanges');
    }
};
