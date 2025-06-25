<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PackAlimentaire;
use App\Models\PackScolaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Added for transaction

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['packAlimentaires', 'packScolaires'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packAlimentaires = PackAlimentaire::orderBy('nom')->get();
        $packScolaires = PackScolaire::orderBy('nom')->get();
        return view('admin.orders.create', compact('packAlimentaires', 'packScolaires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string',
            'order_date' => 'required|date',
            'pack_alimentaires' => 'nullable|array',
            'pack_alimentaires.*' => 'exists:pack_alimentaires,id',
            'pack_scolaires' => 'nullable|array',
            'pack_scolaires.*' => 'exists:pack_scolaires,id',
            'status' => 'required|string|in:pas encore livré,livré',
            // total_price will be calculated
        ]);

        // Validation pour s'assurer qu'au moins un type de pack est sélectionné
        if (empty($validatedData['pack_alimentaires']) && empty($validatedData['pack_scolaires'])) {
            return redirect()->back()->withInput()->with('error', 'Veuillez sélectionner au moins un pack.');
        }

        DB::beginTransaction();
        try {
            $totalPrice = 0;

            // Calcul du prix pour les packs alimentaires
            if (isset($validatedData['pack_alimentaires'])) {
                $foodPacks = PackAlimentaire::findMany($validatedData['pack_alimentaires']);
                foreach ($foodPacks as $pack) {
                    $totalPrice += $pack->prix;
                }
            }

            // Calcul du prix pour les packs scolaires
            if (isset($validatedData['pack_scolaires'])) {
                $schoolPacks = PackScolaire::findMany($validatedData['pack_scolaires']);
                foreach ($schoolPacks as $pack) {
                    $totalPrice += $pack->prix;
                }
            }

            $order = Order::create([
                'client_name' => $validatedData['client_name'],
                'client_phone' => $validatedData['client_phone'],
                'delivery_address' => $validatedData['delivery_address'],
                'order_date' => $validatedData['order_date'],
                'total_price' => $totalPrice,
                'status' => $validatedData['status'],
            ]);

            // Attacher les packs alimentaires avec leur prix au moment de la commande
            if (isset($validatedData['pack_alimentaires'])) {
                $attachData = [];
                foreach ($foodPacks as $pack) {
                    $attachData[$pack->id] = [
                        'price_at_time' => $pack->prix,
                        'quantity' => 1
                    ];
                }
                $order->packAlimentaires()->attach($attachData);
            }

            // Attacher les packs scolaires avec leur prix au moment de la commande
            if (isset($validatedData['pack_scolaires'])) {
                $attachData = [];
                foreach ($schoolPacks as $pack) {
                    $attachData[$pack->id] = [
                        'price_at_time' => $pack->prix,
                        'quantity' => 1
                    ];
                }
                $order->packScolaires()->attach($attachData);
            }
            
            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Commande créée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la création de la commande: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['packAlimentaires', 'packScolaires']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $packAlimentaires = PackAlimentaire::orderBy('nom')->get();
        $packScolaires = PackScolaire::orderBy('nom')->get();
        $order->load(['packAlimentaires', 'packScolaires']); // Eager load for pre-selection
        return view('admin.orders.edit', compact('order', 'packAlimentaires', 'packScolaires'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string',
            'order_date' => 'required|date',
            'pack_alimentaires' => 'nullable|array',
            'pack_alimentaires.*' => 'exists:pack_alimentaires,id',
            'pack_scolaires' => 'nullable|array',
            'pack_scolaires.*' => 'exists:pack_scolaires,id',
            'status' => 'required|string|in:pas encore livré,livré',
        ]);

        // Validation pour s'assurer qu'au moins un type de pack est sélectionné
        if (empty($validatedData['pack_alimentaires']) && empty($validatedData['pack_scolaires'])) {
            return redirect()->back()->withInput()->with('error', 'Veuillez sélectionner au moins un pack.');
        }

        DB::beginTransaction();
        try {
            $totalPrice = 0;

            // Calcul du prix pour les packs alimentaires
            if (isset($validatedData['pack_alimentaires'])) {
                $foodPacks = PackAlimentaire::findMany($validatedData['pack_alimentaires']);
                foreach ($foodPacks as $pack) {
                    $totalPrice += $pack->prix;
                }
            }

            // Calcul du prix pour les packs scolaires
            if (isset($validatedData['pack_scolaires'])) {
                $schoolPacks = PackScolaire::findMany($validatedData['pack_scolaires']);
                foreach ($schoolPacks as $pack) {
                    $totalPrice += $pack->prix;
                }
            }

            $order->update([
                'client_name' => $validatedData['client_name'],
                'client_phone' => $validatedData['client_phone'],
                'delivery_address' => $validatedData['delivery_address'],
                'order_date' => $validatedData['order_date'],
                'total_price' => $totalPrice,
                'status' => $validatedData['status'],
            ]);

            // Synchroniser les packs alimentaires avec leur prix au moment de la commande
            if (isset($validatedData['pack_alimentaires'])) {
                $syncData = [];
                foreach ($foodPacks as $pack) {
                    $syncData[$pack->id] = [
                        'price_at_time' => $pack->prix,
                        'quantity' => 1
                    ];
                }
                $order->packAlimentaires()->sync($syncData);
            } else {
                $order->packAlimentaires()->sync([]);
            }

            // Synchroniser les packs scolaires avec leur prix au moment de la commande
            if (isset($validatedData['pack_scolaires'])) {
                $syncData = [];
                foreach ($schoolPacks as $pack) {
                    $syncData[$pack->id] = [
                        'price_at_time' => $pack->prix,
                        'quantity' => 1
                    ];
                }
                $order->packScolaires()->sync($syncData);
            } else {
                $order->packScolaires()->sync([]);
            }
            
            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Commande mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour de la commande: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return redirect()->route('admin.orders.index')->with('success', 'Commande supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.index')->with('error', 'Erreur lors de la suppression de la commande: ' . $e->getMessage());
        }
    }
}
