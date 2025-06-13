<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('account_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->string('action');                // e.g., login, logout, password_change
            $table->text('description')->nullable(); // optional details
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_logs');
    }
};
