<?php

namespace App\Http\Controllers;

use App\Models\concours;
use App\Models\epreuve;
use App\Models\couple;
use Illuminate\Http\Request;

class ConcoursController extends Controller
{
    public function index(){
        $listeConcours = concours::all();
        return view('index',compact("listeConcours"));
    }


    public function listing($idConcours,$numListeEpreuve){
        $concours = concours::find($idConcours);
        $listeEpreuves = $concours->epreuves()->orderByRaw("CASE WHEN statut = 'en cours' THEN 0 ELSE 1 END")->get();
        //$listeEpreuves = $concours->epreuves()->orderByRaw("FIELD(statut, 'en cours', 'à venir', 'terminé', 'cloturée')")->orderBy('ordre', 'desc')->get();
        $epreuve = $listeEpreuves[$numListeEpreuve-1];
        
        //dd($epreuve->titre,$epreuve->id,$numListeEpreuve,$epreuve->couples()->get());

        return response()->view('couple', [
            "listeEpreuves"=>$listeEpreuves,
            "idConcours"=>$idConcours,
            "epreuve"=>$epreuve
        ])
        ->header("Refresh", "5")
        ;
                         
    }
    
    
}
