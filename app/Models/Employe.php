<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Employe 
{
   

    public function ajouterEmploye($nom, $prenom, $poste, $id_manager)
    {
        DB::insert("
        INSERT INTO employes (nom, prenom, poste, id_manager)
        VALUES (?, ?, ?, ?)", 
        [$nom, $prenom, $poste, $id_manager]
    );

    return "Employé ajouté avec succès.";
    }

    public function getEmployesByIdManager($id_manager)
    {
        return DB::select('SELECT * FROM employes WHERE id_manager = ?', [$id_manager]);
    }

    public function getAllEmployes()
    {
        return DB::select('SELECT * FROM employes');
    }



    
}

