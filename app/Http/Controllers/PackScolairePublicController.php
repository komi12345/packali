<?php

namespace App\Http\Controllers;

use App\Models\PackScolaire;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PackScolairePublicController extends Controller
{
    public function index()
    {
        // Récupérer tous les packs scolaires avec leurs promotions actives
        $packsScolaires = PackScolaire::with(['promotions' => function ($query) {
            $query->where('date_debut', '<=', Carbon::now())
                  ->where('date_fin', '>=', Carbon::now());
        }])->orderBy('niveau_scolaire')->get();

        // Pour chaque pack, déterminer le prix à afficher (normal ou promotionnel)
        $packsScolaires->each(function ($pack) {
            $activePromotion = $pack->promotions->first();
            if ($activePromotion) {
                $pack->prix_original = $pack->prix;
                $pack->prix = $activePromotion->prix_promotionnel;
                $pack->en_promotion = true;
            } else {
                $pack->en_promotion = false;
            }
        });

        return view('packs-scolaires', compact('packsScolaires'));
    }
}
