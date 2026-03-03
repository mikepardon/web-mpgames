<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oauth_users', function (Blueprint $table) {
            $table->id();
            $table->string('oauth_id')->unique();
            $table->string('username');
            $table->string('email')->nullable();
            $table->string('avatar_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oauth_users');
    }
};
