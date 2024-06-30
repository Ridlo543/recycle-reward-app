<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_reward_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('reward_id')->constrained()->onDelete('cascade');
            $table->dateTime('redeemed_at');
            $table->timestamps();
            
            $table->unique(['user_id', 'reward_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_reward_users');
    }
};
