<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->json('modes')->nullable()->after('features');
            $table->json('faq')->nullable()->after('modes');
            $table->text('long_description')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn(['modes', 'faq', 'long_description']);
        });
    }
};
