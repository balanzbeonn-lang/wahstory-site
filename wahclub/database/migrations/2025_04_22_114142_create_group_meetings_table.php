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
        Schema::create('group_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('users');
            $table->date('meeting_date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('member_timezone', 255)->nullable();
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled', 'Completed']);
            $table->string('google_meet_link')->nullable();
            $table->string('meeting_title')->nullable();
            $table->text('meeting_notes')->nullable();
            $table->enum('reschedule_status', ['Requested', 'Acknowledged', 'Completed'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_meetings');
    }
};
