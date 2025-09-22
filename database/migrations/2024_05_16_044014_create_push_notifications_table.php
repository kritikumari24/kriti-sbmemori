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
        Schema::create('push_notifications', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('members')->default(1);
            $table->string('title')->nullable();
            $table->string('messages')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: Active 0:Inactive');
            $table->timestamp('notification_time')->nullable();
            $table->integer('is_notified')->nullable();
            $table->integer('direct_notification')->nullable();
            $table->integer('link_id')->nullable();
            $table->string('link_type')->nullable();
            $table->string('user_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('push_notifications');
    }
};
