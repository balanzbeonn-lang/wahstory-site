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
        Schema::create('subsc_plan_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('subsc_plans')->onDelete('cascade');
            $table->string('point_name')->nullable(); // The name of the point/feature (e.g., "Storage", "Bandwidth")
            $table->integer('point_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsc_plan_points');
    }
};
