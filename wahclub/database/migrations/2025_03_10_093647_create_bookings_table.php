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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('member_id')->constrained('users');
            $table->date('slot_date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('slot_timezone', 255)->nullable();
            $table->enum('status', ['Pending', 'Confirmed', 'Rejected', 'Withdrawal', 'Cancelled', 'Completed']);
            $table->string('google_meet_link')->nullable();
            $table->text('meeting_notes')->nullable();
            $table->enum('reschedule_status', ['Requested', 'Acknowledged', 'Completed'])->nullable();
            $table->enum('cancelled_by', ['User', 'Member'])->nullable();
            $table->dateTime('cancellation_time')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
