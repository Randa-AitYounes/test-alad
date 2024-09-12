<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_conges', function (Blueprint $table) {
            $table->increments('id_demande');
            $table->date('depart');
            $table->date('retour');
            $table->text('commentaire')->nullable();
            $table->enum('statut', ['En attente', 'Acceptée', 'Refusée']);
$table->text('commentaire_manager')->nullable();
$table->unsignedInteger('id_employe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande_conges');
    }
};
