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
        Schema::create('request_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('url');
            $table->string('full_url');
            $table->string('method');
            $table->text('payload')->nullable();
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->integer('status_code');
            $table->text('response_content')->nullable();
            $table->float('response_time');
            $table->timestamps();
            $table->index(['user_id', 'url', 'full_url', 'method', 'ip_address', 'user_agent', 'status_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_logs');
    }
};
