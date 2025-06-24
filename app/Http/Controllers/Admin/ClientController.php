<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class ClientController extends Controller
{
    public function index()
    {
        $deliveredOrdersClients = Order::with('packAlimentaires')
                                      ->where('status', 'livré')
                                      ->orderBy('order_date', 'desc')
                                      ->get();

        $pendingOrdersClients = Order::with('packAlimentaires')
                                     ->where('status', '!=', 'livré')
                                     ->orderBy('order_date', 'desc')
                                     ->get();

       return view('admin.clients.index', compact('deliveredOrdersClients', 'pendingOrdersClients'));
   }

   public function showClientOrders($client_phone, $client_name)
   {
       $client_name = urldecode($client_name); // Décoder le nom du client au cas où il contiendrait des espaces encodés
       $orders = Order::with('packAlimentaires')
                       ->where('client_phone', $client_phone)
                       ->where('client_name', $client_name)
                       ->orderBy('order_date', 'desc')
                       ->get();

       if ($orders->isEmpty()) {
           // Gérer le cas où aucun client/commande n'est trouvé, bien que cela soit peu probable si on vient d'un lien de recherche
           return redirect()->route('admin.clients.index')->with('error', 'Aucune commande trouvée pour ce client.');
       }

       // Passer le nom et le téléphone à la vue pour l'affichage
       return view('admin.clients.show_orders', compact('orders', 'client_name', 'client_phone'));
   }
}
