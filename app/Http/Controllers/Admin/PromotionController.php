<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackAlimentaire;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::with('packAlimentaire')->latest()->paginate(10);
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packsAlimentaires = PackAlimentaire::orderBy('nom')->get();
        return view('admin.promotions.create', compact('packsAlimentaires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pack_alimentaire_id' => 'required|exists:pack_alimentaires,id',
            'prix_promotionnel' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        Promotion::create($request->all());

        return redirect()->route('admin.promotions.index')
                         ->with('success', 'Promotion créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        $promotion->load('packAlimentaire');
        return view('admin.promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        $packsAlimentaires = PackAlimentaire::orderBy('nom')->get();
        return view('admin.promotions.edit', compact('promotion', 'packsAlimentaires'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'pack_alimentaire_id' => 'required|exists:pack_alimentaires,id',
            'prix_promotionnel' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $promotion->update($request->all());

        return redirect()->route('admin.promotions.index')
                         ->with('success', 'Promotion mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('admin.promotions.index')
                         ->with('success', 'Promotion supprimée avec succès.');
    }
}
