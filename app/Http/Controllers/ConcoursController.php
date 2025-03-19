<?php

namespace App\Http\Controllers;

use App\Models\concours;
use Illuminate\Http\Request;

class ConcoursController extends Controller
{
    public function index(){
        $listeConcours = concours::all();
        return view('index',compact("listeConcours"));
    }
}
