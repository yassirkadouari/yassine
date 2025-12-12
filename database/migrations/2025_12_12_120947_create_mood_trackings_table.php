<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoodTrackingsTable extends Migration
{
    public function up()
    {
        Schema::create('mood_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('mood', ['very_happy', 'happy', 'neutral', 'sad', 'very_sad', 'anxious', 'angry', 'tired']);
            $table->integer('energy_level')->nullable()->comment('1-10 scale');
            $table->integer('stress_level')->nullable()->comment('1-10 scale');
            $table->integer('sleep_quality')->nullable()->comment('1-10 scale');
            $table->text('notes')->nullable();
            $table->date('date');
            $table->timestamps();
            
            $table->unique(['user_id', 'date']);
        });
    }
}