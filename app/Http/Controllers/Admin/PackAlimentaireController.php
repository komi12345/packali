<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackAlimentaire;
use Illuminate\Http\Request;

class PackAlimentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packs = PackAlimentaire::all();
        return view('admin.packs.index', compact('packs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'contenu' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('site_assets/images/packs'), $imageName);
            $data['image'] = 'packs/'.$imageName;
        }

        PackAlimentaire::create($data);

        return redirect()->route('admin.packs.index')
                        ->with('success','Pack alimentaire créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PackAlimentaire $packAlimentaire)
    {
        return view('admin.packs.show',compact('packAlimentaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackAlimentaire $packAlimentaire)
    {
        return view('admin.packs.edit',compact('packAlimentaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackAlimentaire $packAlimentaire)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'contenu' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($packAlimentaire->image && file_exists(public_path('site_assets/images/' . $packAlimentaire->image))) {
                unlink(public_path('site_assets/images/' . $packAlimentaire->image));
            }
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('site_assets/images/packs'), $imageName);
            $data['image'] = 'packs/'.$imageName;
        } else {
            unset($data['image']);
        }

        $packAlimentaire->update($data);

        return redirect()->route('admin.packs.index')
                        ->with('success','Pack alimentaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackAlimentaire $packAlimentaire)
    {
        // Supprimer l'image si elle existe
        if ($packAlimentaire->image && file_exists(public_path('site_assets/images/' . $packAlimentaire->image))) {
            unlink(public_path('site_assets/images/' . $packAlimentaire->image));
        }
        $packAlimentaire->delete();

        return redirect()->route('admin.packs.index')
                        ->with('success','Pack alimentaire supprimé avec succès.');
    }
}