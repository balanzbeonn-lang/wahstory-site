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
        Schema::create('lets_work_queries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('firstname', 55)->nullable();
            $table->string('lastname', 55)->nullable();
            $table->string('email', 55)->unique(); 
            $table->string('dialcode', 55)->nullable(); 
            $table->string('phone', 55)->nullable(); 
            $table->text('message')->nullable(); 
            $table->string('status', 30)->default('new'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lets_work_queries');
    }
};
