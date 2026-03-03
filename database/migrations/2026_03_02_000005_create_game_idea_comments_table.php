<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_idea_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_idea_id')->constrained()->cascadeOnDelete();
            $table->foreignId('oauth_user_id')->constrained()->cascadeOnDelete();
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_idea_comments');
    }
};
