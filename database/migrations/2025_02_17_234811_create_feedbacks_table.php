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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id'); // Chave estrangeira para eventos
            $table->string('name'); // Nome do usuário que deu o feedback
            $table->text('comment'); // Comentário do feedback
            $table->integer('rating'); // Nota de 1 a 5
            $table->timestamps();
    
            // Relacionamento com a tabela de eventos
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
