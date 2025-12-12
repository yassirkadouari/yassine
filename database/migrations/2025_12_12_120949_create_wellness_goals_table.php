<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWellnessGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('wellness_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['physical', 'emotional', 'social', 'professional', 'spiritual']);
            $table->date('start_date');
            $table->date('target_date');
            $table->enum('status', ['in_progress', 'completed', 'abandoned'])->default('in_progress');
            $table->integer('progress')->default(0)->comment('Percentage');
            $table->timestamps();
        });
    }
}