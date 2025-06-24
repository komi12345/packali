<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PackAlimentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Added for transaction

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('packAlimentaires')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packAlimentaires = PackAlimentaire::orderBy('nom')->get();
        return view('admin.orders.create', compact('packAlimentaires'));
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
            'pack_alimentaires' => 'required|array|min:1',
            'pack_alimentaires.*' => 'exists:pack_alimentaires,id',
            'status' => 'required|string|in:pas encore livré,livré',
            // total_price will be calculated
        ]);

        DB::beginTransaction();
        try {
            $totalPrice = 0;
            if (isset($validatedData['pack_alimentaires'])) {
                $packs = PackAlimentaire::findMany($validatedData['pack_alimentaires']);
                foreach ($packs as $pack) {
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

            if (isset($validatedData['pack_alimentaires'])) {
                $order->packAlimentaires()->attach($validatedData['pack_alimentaires']);
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
        $order->load('packAlimentaires');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $packAlimentaires = PackAlimentaire::orderBy('nom')->get();
        $order->load('packAlimentaires'); // Eager load for pre-selection
        return view('admin.orders.edit', compact('order', 'packAlimentaires'));
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
            'pack_alimentaires' => 'required|array|min:1',
            'pack_alimentaires.*' => 'exists:pack_alimentaires,id',
            'status' => 'required|string|in:pas encore livré,livré',
        ]);

        DB::beginTransaction();
        try {
            $totalPrice = 0;
            if (isset($validatedData['pack_alimentaires'])) {
                $packs = PackAlimentaire::findMany($validatedData['pack_alimentaires']);
                foreach ($packs as $pack) {
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

            if (isset($validatedData['pack_alimentaires'])) {
                $order->packAlimentaires()->sync($validatedData['pack_alimentaires']);
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
