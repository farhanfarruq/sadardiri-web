<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitLogsTable extends Migration
{
    public function up()
    {
        Schema::create('habit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('habit_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('count')->default(1);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['habit_id', 'date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('habit_logs');
    }
}