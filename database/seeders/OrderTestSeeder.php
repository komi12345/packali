<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\PackAlimentaire;
use App\Models\PackScolaire;

class OrderTestSeeder extends Seeder
{
    public function run()
    {
        $packAlimentaire = PackAlimentaire::first();
        $packScolaire = PackScolaire::first();

        if ($packAlimentaire && $packScolaire) {
            // Commande avec pack alimentaire
            $order1 = Order::create([
                'client_name' => 'Jean Dupont',
                'client_phone' => '0123456789',
                'delivery_address' => '123 Rue de la Paix, Paris',
                'order_date' => now(),
                'total_price' => $packAlimentaire->prix,
                'status' => 'livré'
            ]);
            $order1->packAlimentaires()->attach($packAlimentaire->id, [
                'price_at_time' => $packAlimentaire->prix,
                'quantity' => 1
            ]);

            // Commande avec pack scolaire
            $order2 = Order::create([
                'client_name' => 'Marie Martin',
                'client_phone' => '0987654321',
                'delivery_address' => '456 Avenue des Écoles, Lyon',
                'order_date' => now(),
                'total_price' => $packScolaire->prix,
                'status' => 'pas encore livré'
            ]);
            $order2->packScolaires()->attach($packScolaire->id, [
                'price_at_time' => $packScolaire->prix,
                'quantity' => 1
            ]);
        }
    }
}
