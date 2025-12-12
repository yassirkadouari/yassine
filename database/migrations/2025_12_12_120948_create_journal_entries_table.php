<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->enum('entry_type', ['gratitude', 'reflection', 'challenge', 'achievement', 'general']);
            $table->json('tags')->nullable();
            $table->boolean('is_private')->default(true);
            $table->timestamps();
        });
    }
}