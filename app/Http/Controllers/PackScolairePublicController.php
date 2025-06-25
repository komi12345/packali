<?php

namespace App\Http\Controllers;

use App\Models\PackScolaire;
use Illuminate\Http\Request;

class PackScolairePublicController extends Controller
{
    public function index()
    {
        $packsScolaires = PackScolaire::orderBy('niveau_scolaire')->get();
        return view('packs-scolaires', compact('packsScolaires'));
    }
}
