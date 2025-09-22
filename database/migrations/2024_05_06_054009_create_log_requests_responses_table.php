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
        Schema::create('log_requests_responses', function (Blueprint $table) {
            $table->id();
            $table->text("request")->nullable();
            $table->text("response")->nullable();
            $table->string("url", 1024)->nullable();
            $table->string("ip", 16)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_requests_responses');
    }
};
