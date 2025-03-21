<?php

namespace App\Http\Controllers;

use App\Models\concours;
use App\Models\epreuve;
use App\Models\couple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConcoursController extends Controller
{
    public function index(){
        $listeConcours = concours::all();
        return view('index',compact("listeConcours"));
    }

    public function allEpreuves($id){
        $concours=concours::find($id);
        $listeEpreuves = $concours->epreuves()->orderBy('ordre', 'asc')->get();
        return view('epreuves',compact("listeEpreuves"));
    }

    public function listing($idConcours,$numListeEpreuve){
        $concours = concours::find($idConcours);
        $listeEpreuves = $concours->epreuves()->orderByRaw("CASE WHEN statut = 'en cours' THEN 0 WHEN statut = 'à venir' THEN 1 ELSE 2 END")->orderBy('ordre','asc')->get();
        //$listeEpreuves = $concours->epreuves()->whereIn('classement', ['non partant', 'fini', 'éliminé'])->orderByRaw("CASE WHEN statut = 'en cours' THEN 0 ELSE 1 END")->orderBy('ordre','asc')->get();
        //$listeEpreuves = $concours->epreuves()->orderByRaw("FIELD(statut, 'en cours', 'à venir', 'terminé', 'cloturée')")->orderBy('ordre', 'desc')->get();
        $epreuve = $listeEpreuves[$numListeEpreuve-1];
        $listeCouples=$epreuve->couples()->whereIn('classement', ['partant', 'en bord de piste', 'en piste'])->get();
        $listeCouplesFini = $epreuve->couples()
        ->whereNotIn('classement', ['partant', 'en bord de piste', 'en piste'])
        ->orderByRaw("CASE WHEN classement REGEXP '^[0-9]+$' THEN 0 WHEN classement = 'fini' THEN 1 WHEN classement = 'elimine' THEN 2 ELSE 3 END")
        ->orderBy('classement', 'asc')
        ->get();

        //dd($epreuve->titre,$epreuve->id,$numListeEpreuve,$epreuve->couples()->get());

        return response()->view('couple', [
            "listeEpreuves"=>$listeEpreuves,
            "idConcours"=>$idConcours,
            "concours"=>$concours,
            "epreuve"=>$epreuve,
            "listeCouples"=>$listeCouples,
            "listeCouplesFini"=>$listeCouplesFini
        ])
        ->header("Refresh", "15")
        ;                 
    }

    public function commencerEpreuve($idEpreuve){
        //dd($idEpreuve);
        $epreuve=epreuve::find($idEpreuve);
        $epreuve->update([
            'statut' => "en cours",
        ]);
        return redirect()->back();
    }

    public function terminerEpreuve($idEpreuve){
        //dd($idEpreuve);
        $epreuve=epreuve::find($idEpreuve);
        $listeCouples=$epreuve->couples()->get();
        $entierementRempli=true;
        foreach($listeCouples as $couple){
            if($couple->classement == "partant" && $couple->classement == "en piste" && $couple->classement == "en bord de piste"){
                $entierementRempli=false;
            }
        }
        if($entierementRempli){
            $epreuve->update([
                'statut' => "terminee",
            ]);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function cloturerEpreuve($idEpreuve){
        $epreuve=epreuve::find($idEpreuve);
        // dd($epreuve->concours_id);
        $concours=concours::find($epreuve->concours_id);
        $epreuve->update([
            'statut' => "cloture",
        ]);
        $listeCouplesFini=$epreuve->couples()->where('classement', 'fini')->get();
        // assigne le temps total pour chaque couple ayant fini le parcours zz
        foreach($listeCouplesFini as $couple){
             if($concours->type="Equifun"){
                $temps_total=$this->convertToSeconds($couple->temps)+$couple->penalite;
                $temps_total_timer=$this->convertSecondsToTime($temps_total);
                // dd($temps_total_timer);
                $couple->update([
                    'temps_total'=>$temps_total_timer
                ]);
             }else{
                $couple->update([
                    'temps_total'=>$couple->temps
                ]);
             }
        }
        $sortedCouplesEquifun = $listeCouplesFini->sortBy('temps_total');
        $sortedCouplesCSO = $listeCouplesFini->sortBy(function ($couple) {
            return [$couple->penalite, $couple->temps_total];
        });
        $rang=1;
        if($concours->type="Equifun"){
            foreach($sortedCouplesEquifun as $coupleEquifun){
                $coupleEquifun->update([
                    'classement'=>$rang
                ]);
                $rang++;
            }
        }else{
            foreach($sortedCouplesCSO as $coupleCSO){
                $coupleCSO->update([
                    'classement'=>$rang
                ]);
                $rang++;
            }
            $rang++;
        }

        return redirect()->back();
    }

    public function convertToSeconds($time) {
        // Séparer le temps au format HH:MM:SS
        list($hours, $minutes, $seconds) = explode(':', $time);
        
        // Convertir en secondes
        $total_seconds = ($hours * 3600) + ($minutes * 60) + $seconds;
        
        return $total_seconds;
    }

    private function convertSecondsToTime($seconds)
    {
        // Calculer les heures, minutes et secondes
        $hours = floor($seconds / 3600);  // Diviser par 3600 pour obtenir les heures
        $minutes = floor(($seconds % 3600) / 60);  // Récupérer le reste et diviser par 60 pour les minutes
        $seconds = $seconds % 60;  // Récupérer le reste des secondes

        // Formater le temps en 'HH:MM:SS'
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    
    public function notifierBordPiste($idCouple){
        //dd($idEpreuve);
        $couple=couple::find($idCouple);
        $couple->update([
            'classement' => "en bord de piste",
        ]);
        return redirect()->back();
    }

    public function notifierEnPiste($idCouple){
        //dd($idEpreuve);
        $couple=couple::find($idCouple);
        $couple->update([
            'classement' => "en piste",
        ]);
        return redirect()->back();
    }

    public function notifierFini(Request $request, $idCouple){
        //dd($idEpreuve);
        // $couple=couple::find($idCouple);
        // if (is_null($couple->temps && $couple->penalite && $couple->temps)) {
        //     return back()->withErrors(['fini' => 'Veuillez indiquer le temps et les pénalités avant de mettre le statut du couple à fini']);
        // }else{

        // }
        // $couple->update([
        //     'classement' => "en piste",
        // ]);
        // return redirect()->back();
        $couple = couple::find($idCouple);
        $request->validate([
            'temps' => 'required|date_format:H:i:s',
            'penalite' => 'required|integer|min:0',
        ]);
    
        
        $couple->update([
            'temps' => $request->temps,
            'penalite' => $request->penalite,
            'classement' => "fini",
        ]);
    
        return redirect()->back();
    }

    public function notifierNonPartant($idCouple){
        $couple=couple::find($idCouple);
        $couple->update([
            'classement' => "non partant",
        ]);
        return redirect()->back();
    }

    public function notifierElimine($idCouple){
        $couple=couple::find($idCouple);
        $couple->update([
            'classement' => "elimine",
        ]);
        return redirect()->back();
    }
}
