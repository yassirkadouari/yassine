<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['medication', 'appointment', 'activity', 'hydration', 'break']);
            $table->time('reminder_time');
            $table->json('days_of_week')->nullable()->comment('Array of days: [1,2,3,4,5,6,7]');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_triggered')->nullable();
            $table->timestamps();
        });
    }
}