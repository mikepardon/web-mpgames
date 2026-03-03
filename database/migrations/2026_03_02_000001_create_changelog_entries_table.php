<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('changelog_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->cascadeOnDelete();
            $table->string('version');
            $table->string('title');
            $table->text('description');
            $table->date('published_at');
            $table->enum('category', ['feature', 'bug_fix', 'improvement', 'balance']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('changelog_entries');
    }
};
