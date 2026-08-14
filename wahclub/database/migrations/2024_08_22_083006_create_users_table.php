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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('title', 10)->nullable();
            $table->string('firstname', 35)->nullable();
            $table->string('lastname', 35)->nullable(); 
            $table->string('slug_username', 255)->unique(); 
            $table->string('photo')->nullable(); 
            $table->string('dialcode', 5)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 55)->unique();  
            $table->string('totalexperience', 5)->nullable();
            $table->string('totalproject', 5)->nullable();
            $table->string('totalclients', 15)->nullable();
            $table->string('totalawards', 5)->nullable();
            $table->string('otherIndustries', 255)->nullable();
            $table->string('otherskills', 255)->nullable();
            $table->string('otherTools', 255)->nullable();
            $table->integer('views')->default(0);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
