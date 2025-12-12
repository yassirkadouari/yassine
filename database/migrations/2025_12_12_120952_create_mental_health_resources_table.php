<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentalHealthResourcesTable extends Migration
{
    public function up()
    {
        Schema::create('mental_health_resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['article', 'video', 'podcast', 'exercise', 'tool']);
            $table->string('url');
            $table->enum('category', ['anxiety', 'depression', 'stress', 'mindfulness', 'sleep', 'relationships']);
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced']);
            $table->integer('duration_minutes')->nullable();
            $table->timestamps();
        });
    }
}