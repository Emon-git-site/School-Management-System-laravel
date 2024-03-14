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
        Schema::create('assign_class_teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('classe_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->integer('status')->default(0);
            $table->integer('is_delete')->default(0);
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_class_teachers');
    }
};
