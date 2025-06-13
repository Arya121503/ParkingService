<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vip_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->enum('level', ['regular', 'vip'])->default('regular');
            $table->date('expires_at')->nullable(); // tanggal berakhir membership
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vip_memberships');
    }
};
