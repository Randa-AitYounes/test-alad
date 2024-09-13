<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function ajouterEmploye(Request $request)
    {
        $employe = new Employe();
        $result = $employe->ajouterEmploye(
            $request->input('nom'),
            $request->input('prenom'),
            $request->input('poste'),
            $request->input('id_manager')
        );

        return response()->json(['message' => $result], 200);
    }

    public function listeEmployes($id_manager)
    {
        $employe = new Employe();
        $employes = $employe->getEmployesByIdManager($id_manager);

        return response()->json($employes, 200);
    }
}

?>