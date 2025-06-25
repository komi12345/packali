<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackAlimentaire;
use App\Models\PackScolaire;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with(['packAlimentaire', 'packScolaire'])->latest()->paginate(10);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $packsAlimentaires = PackAlimentaire::orderBy('nom')->get();
        $packsScolaires = PackScolaire::orderBy('nom')->get();
        return view('admin.promotions.create', compact('packsAlimentaires', 'packsScolaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_pack' => 'required|in:alimentaire,scolaire',
            'pack_alimentaire_id' => 'required_if:type_pack,alimentaire|exists:pack_alimentaires,id',
            'pack_scolaire_id' => 'required_if:type_pack,scolaire|exists:pack_scolaires,id',
            'prix_promotionnel' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $data = $request->all();
        
        // S'assurer que seul l'ID du type de pack sélectionné est défini
        if ($request->type_pack === 'alimentaire') {
            $data['pack_scolaire_id'] = null;
        } else {
            $data['pack_alimentaire_id'] = null;
        }

        Promotion::create($data);

        return redirect()->route('admin.promotions.index')
                         ->with('success', 'Promotion créée avec succès.');
    }

    public function show(Promotion $promotion)
    {
        $promotion->load(['packAlimentaire', 'packScolaire']);
        return view('admin.promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        $packsAlimentaires = PackAlimentaire::orderBy('nom')->get();
        $packsScolaires = PackScolaire::orderBy('nom')->get();
        return view('admin.promotions.edit', compact('promotion', 'packsAlimentaires', 'packsScolaires'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'type_pack' => 'required|in:alimentaire,scolaire',
            'pack_alimentaire_id' => 'required_if:type_pack,alimentaire|exists:pack_alimentaires,id',
            'pack_scolaire_id' => 'required_if:type_pack,scolaire|exists:pack_scolaires,id',
            'prix_promotionnel' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $data = $request->all();
        
        // S'assurer que seul l'ID du type de pack sélectionné est défini
        if ($request->type_pack === 'alimentaire') {
            $data['pack_scolaire_id'] = null;
        } else {
            $data['pack_alimentaire_id'] = null;
        }

        $promotion->update($data);

        return redirect()->route('admin.promotions.index')
                         ->with('success', 'Promotion mise à jour avec succès.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('admin.promotions.index')
                         ->with('success', 'Promotion supprimée avec succès.');
    }
}
