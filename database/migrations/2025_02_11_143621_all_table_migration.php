<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Table users
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID primaire, BIGINT(20), UNSIGNED, AUTO_INCREMENT
            $table->string('name'); // Nom de l'utilisateur (type VARCHAR(255))
            $table->string('email')->unique(); // Email de l'utilisateur, unique (type VARCHAR(255))
            $table->timestamp('email_verified_at')->nullable(); // Date de vérification de l'email
            $table->string('password'); // Mot de passe de l'utilisateur (type VARCHAR(255))
            $table->rememberToken(); // Token pour la fonctionnalité "Se souvenir de moi"
            $table->tinyInteger('active')->default(1)->comment('État de l\'utilisateur, 1 pour actif, 0 pour inactif'); // Actif ou inactif
            $table->softDeletes(); // Suppression douce
            $table->timestamps(); // created_at et updated_at
        });

        // Table supervisions
        Schema::create('supervisions', function (Blueprint $table) {
            $table->id();
            $table->string('domaine');
            $table->string('contenu');
            $table->string('question');
            $table->string('methode');
            $table->text('reponse');
            $table->decimal('note', 8, 2);
            $table->text('commentaire');
            $table->longText('etablissements');
            $table->tinyInteger('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
        
        // Table alluquestions
        Schema::create('alluquestions', function (Blueprint $table) {
            $table->id();
            $table->string('name_question');
            $table->tinyInteger('type')->comment('1=Hotital General MTN, 2=ECD, 3=CHR, 4=ESPC, 5=Hotipal General');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        // Table domaines
        Schema::create('domaines', function (Blueprint $table) {
            $table->id();
            $table->string('name_question');
            $table->tinyInteger('type')->comment('1=Hotital General MTN, 2=ECD, 3=CHR, 4=ESPC, 5=Hotipal General');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        // Table contenus
        Schema::create('contenus', function (Blueprint $table) {
            $table->id();
            $table->string('name_question');
            $table->tinyInteger('type')->comment('1=Hotital General MTN, 2=ECD, 3=CHR, 4=ESPC, 5=Hotipal General');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        // Table notes
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('note_name');
            $table->decimal('value', 8, 2);
            $table->tinyInteger('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        // Table methodes
        Schema::create('methodes', function (Blueprint $table) {
            $table->id();
            $table->string('methode_name');
            $table->tinyInteger('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('syntheses', function (Blueprint $table) {
            $table->id();
            $table->string('domaine');
            $table->integer('points_disponibles')->default(4);
            $table->decimal('points_obtenus', 5, 2);
            $table->decimal('percentage', 5, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('problemes', function (Blueprint $table) {
            $table->id();
            $table->text('probleme');
            $table->text('causes');
            $table->text('actions');
            $table->text('sources');
            $table->string('acteurs');
            $table->string('ressources');
            $table->date('delai');
            $table->timestamps();
            $table->softDeletes(); // Si tu veux la suppression logique
        });

        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('direction_regionale');
            $table->string('district_sanitaire');
            $table->string('etablissement_sanitaire');
            $table->string('categorie_etablissement'); // Champ chaîne de caractères
            $table->string('code_etablissement')->unique();
            $table->string('periode');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->string('responsable');
            $table->string('telephone');
            $table->string('email');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('superviseurs', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('fonction'); 
            $table->string('phone');
            $table->string('email'); 
            $table->softDeletes();
            $table->timestamps(); 
        });
    }

    public function down()
    {
        // Suppression des tables si la migration est annulée
        Schema::dropIfExists('users');
        Schema::dropIfExists('supervisions');
        Schema::dropIfExists('alluquestions');
        Schema::dropIfExists('domaines');
        Schema::dropIfExists('contenus');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('methodes');
        Schema::dropIfExists('syntheses');
        Schema::dropIfExists('problemes');
        Schema::dropIfExists('etablissements');
    }
};
