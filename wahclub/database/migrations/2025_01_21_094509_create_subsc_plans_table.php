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
        Schema::create('subsc_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('monthly_price', 8, 2); // Monthly price
            $table->decimal('yearly_price', 8, 2); // Yearly price
            $table->decimal('monthly_discount', 8, 2)->default(0);
            $table->decimal('yearly_discount', 8, 2)->default(0); 
            $table->string('currency', 3)->default('USD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsc_plans');
    }
};
