<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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

        $packs = \App\Models\PackAlimentaire::where('nom', 'LIKE', "%{$query}%")
                                          ->orWhere('description', 'LIKE', "%{$query}%")
                                          ->limit(5) // Limiter le nombre de résultats pour le modal
                                          ->get();
        
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
                $pack->url = route('admin.packs.show', $pack);
            });
            // $clients est maintenant formaté avec la bonne URL
            return response()->json(compact('packs', 'clients'));
        }

        // Pour la vue search_results, nous devons aussi passer les clients formatés
        return view('admin.search_results', compact('packs', 'clients', 'query'));
    }
}