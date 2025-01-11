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
        Schema::create('domaineselects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du domaine
            $table->string('value'); // Valeur utilisée dans le select
            $table->text('description')->nullable(); // Description optionnelle
            $table->boolean('active')->default(true); // Pour activer/désactiver un domaine
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domaineselects');
    }
};
