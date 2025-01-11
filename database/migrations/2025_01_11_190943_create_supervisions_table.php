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
        Schema::create('supervisions', function (Blueprint $table) {
            $table->id();
            $table->string('domaine');
            $table->string('domaine_text');
            $table->string('contenu');
            $table->string('contenu_text');
            $table->string('question');
            $table->string('question_text');
            $table->string('methode');
            $table->string('methode_text');
            $table->text('reponse');
            $table->string('note');
            $table->string('note_text');
            $table->text('commentaire');
            $table->json('etablissements');
            $table->boolean('active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisions');
    }
};
