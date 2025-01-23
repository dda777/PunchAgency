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
        Schema::table('users', function (Blueprint $table) {
            $table->json('telegram_auth_data')->nullable()->after('remember_token');
            $table->json('google_auth_data')->nullable()->after('remember_token');
            $table->string('name')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telegram_auth_data');
            $table->dropColumn('google_auth_data');
            $table->dropUnique('users_name_unique');
        });
    }
};
