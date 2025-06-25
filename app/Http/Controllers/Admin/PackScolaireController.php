<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackScolaire;
use Illuminate\Http\Request;

class PackScolaireController extends Controller
{
    public function index()
    {
        $packs = PackScolaire::all();
        return view('admin.pack-scolaires.index', compact('packs'));
    }

    public function create()
    {
        return view('admin.pack-scolaires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'contenu' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tag' => 'nullable|string|max:255',
            'niveau_scolaire' => 'nullable|string|max:255'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('site_assets/images/packs'), $imageName);
            $data['image'] = 'packs/'.$imageName;
        }

        PackScolaire::create($data);

        return redirect()->route('admin.pack-scolaires.index')
                        ->with('success', 'Pack scolaire créé avec succès.');
    }

    public function show(PackScolaire $packScolaire)
    {
        return view('admin.pack-scolaires.show', compact('packScolaire'));
    }

    public function edit(PackScolaire $packScolaire)
    {
        return view('admin.pack-scolaires.edit', compact('packScolaire'));
    }

    public function update(Request $request, PackScolaire $packScolaire)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'contenu' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tag' => 'nullable|string|max:255',
            'niveau_scolaire' => 'nullable|string|max:255'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($packScolaire->image && file_exists(public_path('site_assets/images/' . $packScolaire->image))) {
                unlink(public_path('site_assets/images/' . $packScolaire->image));
            }
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('site_assets/images/packs'), $imageName);
            $data['image'] = 'packs/'.$imageName;
        } else {
            unset($data['image']);
        }

        $packScolaire->update($data);

        return redirect()->route('admin.pack-scolaires.index')
                        ->with('success', 'Pack scolaire mis à jour avec succès.');
    }

    public function destroy(PackScolaire $packScolaire)
    {
        if ($packScolaire->image && file_exists(public_path('site_assets/images/' . $packScolaire->image))) {
            unlink(public_path('site_assets/images/' . $packScolaire->image));
        }
        $packScolaire->delete();

        return redirect()->route('admin.pack-scolaires.index')
                        ->with('success', 'Pack scolaire supprimé avec succès.');
    }
}
