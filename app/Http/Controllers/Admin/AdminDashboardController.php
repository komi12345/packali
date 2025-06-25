<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PackScolaire;
use App\Models\PackAlimentaire;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $totalOrders = Order::count();
        
        // Compter les clients uniques basés sur leur numéro de téléphone (commandes sans compte)
        $clientsFromOrders = Order::distinct('client_phone')->count('client_phone');
        // Compter les utilisateurs enregistrés qui ne sont pas admin
        $registeredClients = User::where('is_admin', false)->count();
        // Total des clients = clients avec commandes + utilisateurs enregistrés
        $totalClients = $clientsFromOrders + $registeredClients;
        
        // Revenus (déjà en FCFA car stocké ainsi dans la base de données)
        $totalRevenue = Order::sum('total_price');
        
        // Statistiques des packs alimentaires
        $totalFoodPacks = PackAlimentaire::count();
        $foodPacksSold = Order::whereHas('packAlimentaires')->count();
        $foodPacksRevenue = Order::whereHas('packAlimentaires')->sum('total_price');
        
        // Statistiques des packs scolaires
        $totalSchoolPacks = PackScolaire::count();
        $schoolPacksSold = Order::whereHas('packScolaires')->count();
        $schoolPacksRevenue = Order::whereHas('packScolaires')->sum('total_price');
        
        // Ventes par mois (6 derniers mois)
        $lastSixMonths = collect([]);
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $lastSixMonths->push([
                'month' => $date->format('M'),
                'food_packs' => Order::whereHas('packAlimentaires')
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'school_packs' => Order::whereHas('packScolaires')
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ]);
        }

        // Répartition des ventes par type de pack
        $packDistribution = [
            'food' => $foodPacksSold,
            'school' => $schoolPacksSold,
        ];

        // Top 5 packs alimentaires les plus vendus
        $topFoodPacks = PackAlimentaire::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();

        // Top 5 packs scolaires les plus vendus
        $topSchoolPacks = PackScolaire::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalClients',
            'totalRevenue',
            'totalFoodPacks',
            'foodPacksSold',
            'foodPacksRevenue',
            'totalSchoolPacks',
            'schoolPacksSold',
            'schoolPacksRevenue',
            'lastSixMonths',
            'packDistribution',
            'topFoodPacks',
            'topSchoolPacks'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        if (empty($query)) {
            if ($request->wantsJson()) {
                return response()->json(['packs' => [], 'clients' => []]);
            }
            return view('admin.search_results', ['packs' => collect(), 'clients' => collect(), 'query' => $query]);
        }

        // Recherche dans les packs alimentaires
        $foodPacks = \App\Models\PackAlimentaire::where('nom', 'LIKE', "%{$query}%")
                                               ->orWhere('description', 'LIKE', "%{$query}%")
                                               ->limit(5)
                                               ->get();

        // Recherche dans les packs scolaires
        $schoolPacks = \App\Models\PackScolaire::where('nom', 'LIKE', "%{$query}%")
                                              ->orWhere('description', 'LIKE', "%{$query}%")
                                              ->limit(5)
                                              ->get();
        
        // Fusionner les résultats des packs
        $packs = $foodPacks->concat($schoolPacks);
        
        // Recherche des clients dans la table 'orders'
        $clientOrders = \App\Models\Order::where('client_name', 'LIKE', "%{$query}%")
                                        ->orWhere('client_phone', 'LIKE', "%{$query}%")
                                        ->select('client_name', 'client_phone') // Sélectionner uniquement les champs nécessaires
                                        ->distinct() // Obtenir des combinaisons uniques
                                        ->limit(5)   // Limiter le nombre de clients distincts
                                        ->get();
        
        // Transformer les résultats pour qu'ils ressemblent à une liste de clients pour le modal/vue
        $clients = $clientOrders->map(function ($order) {
            return (object) [ // Créer un objet standard pour la cohérence
                'id' => $order->client_name . '_' . $order->client_phone, // Créer un ID unique pour la clé Alpine
                'name' => $order->client_name,
                'client_phone' => $order->client_phone,
                'email' => null, // Pas d'email directement sur la table order pour le client
                'url' => route('admin.clients.showOrders', ['client_phone' => $order->client_phone, 'client_name' => urlencode($order->client_name)])
            ];
        });

        if ($request->wantsJson()) {
            $packs->each(function ($pack) {
                $pack->url = $pack instanceof PackAlimentaire 
                    ? route('admin.packs.show', $pack)
                    : route('admin.pack-scolaires.show', $pack);
            });
            // $clients est maintenant formaté avec la bonne URL
            return response()->json(compact('packs', 'clients'));
        }

        // Pour la vue search_results, nous devons aussi passer les clients formatés
        return view('admin.search_results', compact('packs', 'clients', 'query'));
    }
}