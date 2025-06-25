<?php

namespace App\Http\Controllers;

use App\Models\PackAlimentaire;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer tous les packs alimentaires avec leurs promotions actives
        $packsAlimentaires = PackAlimentaire::with(['promotions' => function ($query) {
            $query->where('date_debut', '<=', Carbon::now())
                  ->where('date_fin', '>=', Carbon::now());
        }])->get();

        // Pour chaque pack, déterminer le prix à afficher (normal ou promotionnel)
        $packsAlimentaires->each(function ($pack) {
            $activePromotion = $pack->promotions->first();
            if ($activePromotion) {
                $pack->prix_original = $pack->prix;
                $pack->prix = $activePromotion->prix_promotionnel;
                $pack->en_promotion = true;
            } else {
                $pack->en_promotion = false;
            }
        });

        return view('welcome', compact('packsAlimentaires'));
    }
}
