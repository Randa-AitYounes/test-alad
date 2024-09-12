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
        Schema::table('demande_conges', function (Blueprint $table) {
            //
            $table->index('id_employe');
            $table->foreign('id_employe')->references('id_employe')->on('employes');
           
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demande_conges', function (Blueprint $table) {
            //
        });
    }
};
