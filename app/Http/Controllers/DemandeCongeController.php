<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DemandeConge;
use Exception;

class DemandeCongeController extends Controller
{
    public function ajouterDemande(Request $request, $id_employe)
    {
        $demandeConge = new DemandeConge();
        try {
            $result = $demandeConge->ajouterDemande(
                $id_employe,
                $request->input('depart'),
                $request->input('retour'),
                $request->input('commentaire')
            );
            return response()->json(['message' => $result], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function listeDemandeParEmploye($id_employe)
    {
        $demande = new DemandeConge();
        $demande = $demande->DemandeEmploye($id_employe);

        return response()->json($demande, 200);
    }

    public function listeDemandeParManager($id_manager)
    {
        $demande = new DemandeConge();
        $demande = $demande->DemandeCongeByManager($id_manager);

        return response()->json($demande, 200);
    }

    public function mettreAJourStatut(Request $request, $id_employe, $id_demande, $id_manager)
    {
        $demandeConge = new DemandeConge();
        
        try {
            $result = $demandeConge->miseAJourStatut(
                $id_employe,
                $id_demande,
                $id_manager,
                $request->input('statut'),
                $request->input('commentaire_manager')
            );
            return response()->json(['message '.$request->input('id_employe') => $result], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
