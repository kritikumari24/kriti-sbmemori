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
        Schema::create('faqs', function (Blueprint $table) {
            // $table->id();
            // $table->bigInteger('role_id')->nullable();
            // $table->string('section_type')->nullable();
            // $table->text('question')->nullable();
            // $table->text('answer')->nullable();
            // $table->tinyInteger('is_answered')->default(0)->comment('0:UnAnswered, 1:Answered');
            // $table->bigInteger('question_from')->nullable()->comment('user-Id of that user who puts the question.');
            // $table->bigInteger('answered_by')->nullable()->comment('user-Id of that user who answer the question.');
            // $table->tinyInteger('is_active')->default(1)->comment('0:Inactive, 1:Active');
            // $table->timestamps();
            // $table->softDeletes();

            // $table->index('section_type');
            // $table->index('is_answered');
            $table->id();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('0:Inactive, 1:Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
