<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->cascadeOnDelete();
            $table->foreignId('oauth_user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['new', 'rejected', 'in_progress', 'in_beta_testing', 'live'])->default('new');
            $table->unsignedInteger('votes_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_ideas');
    }
};
