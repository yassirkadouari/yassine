<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('activity_name');
            $table->enum('type', ['exercise', 'meditation', 'social', 'hobby', 'learning', 'self_care']);
            $table->integer('duration_minutes');
            $table->integer('mood_before')->nullable()->comment('1-10 scale');
            $table->integer('mood_after')->nullable()->comment('1-10 scale');
            $table->text('notes')->nullable();
            $table->timestamp('performed_at');
            $table->timestamps();
        });
    }
}