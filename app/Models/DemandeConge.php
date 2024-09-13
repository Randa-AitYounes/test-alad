<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Exception;

class DemandeConge 
{

   

    public function ajouterDemande($id_employe, $depart, $retour, $commentaire)
    {
        // verifier si une demande est créee durant cette periode
        $existing = DB::select("
            SELECT * FROM demande_conges 
            WHERE id_employe = ? AND (depart = ? AND retour = ?)", 
            [$id_employe, $retour, $depart]
        );

        if (!empty($existing)) {
            throw new Exception("Un congé existe déjà pour cette période.");
        }

        // ajouter une nouvelle demande
        DB::insert("
            INSERT INTO demande_conges (id_employe, depart, retour, commentaire, statut)
            VALUES (?, ?, ?, ?, 'En attente')", 
            [$id_employe, $depart, $retour, $commentaire]
        );

        return "Demande de congé créée avec succès.";
    }

    // liste des demandes par employé
    public function DemandeEmploye($id_employe)
    {
        return DB::select("
            SELECT * FROM demande_conges WHERE id_employe = ?", 
            [$id_employe]
        );
    }

    // liste des demandes des employés d'un manager
    public function DemandeCongeByManager($id_manager)
    {
        return DB::select('
            SELECT d_c.* 
            FROM demande_conges d_c 
            JOIN employes ON employes.id_employe = d_c.id_employe 
            WHERE employes.id_manager = ?', [$id_manager]);
    }

    private function trouverEmploye($id_employe)
    {
        $sql = "SELECT * FROM employes WHERE id_employe = ?";
        $employes = DB::select($sql, [$id_employe]);
        
       
        
        return $employes[0]; // Retourne l
    }
    

    // mise à jour du statut d'une demande
    public function miseAJourStatut($id_employe, $id_manager, $id_demande, $statut, $commentaireManager = null)
    {

        //vérifier si l'employé appartient au manager
        $employe = $this->trouverEmploye($id_employe);
if($employe->id_manager!= $id_manager){
    throw new Exception("Le manager ne peut pas mettre à jour la demande de congé pour cet employé.");
}

        // verifier si le statut == refusée
        if ($statut === 'Refusée' && empty($commentaireManager)) {
            throw new Exception("Veuillez ajouter un commentaire");
        }

        // mettre à jour la demande
        DB::update("
            UPDATE demande_conges
            SET statut = ?, commentaire_manager = ?
            WHERE id_demande = ? and id_employe = ?", 
            [$statut, $commentaireManager, $id_demande, $id_employe]
        );

        return "Le statut avec (ID: $id_demande) de la demande a été mis à jour avec succès.";
    }

   
    }


   

