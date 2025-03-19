<?php

namespace App\Http\Controllers;

use App\Models\concours;
use App\Models\epreuve;
use Illuminate\Http\Request;

class ConcoursController extends Controller
{
    public function index(){
        $listeConcours = concours::all();
        return view('index',compact("listeConcours"));
    }

    public function allEpreuves(){
        $listeEpreuve = epreuve::all();
        return view('index',compact("listeEpreuve"));
    }
}
