<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackAlimentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'contenu',
        'prix',
        'image',
        'tag',
    ];

    // Si vous avez des casts spécifiques pour certains attributs
    // protected $casts = [
    //     'contenu' => 'array', // Exemple si 'contenu' est stocké en JSON
    // ];

    public function promotions()
    {
        return $this->hasMany(Promotion::class, 'pack_alimentaire_id');
    }

    /**
     * Get the current active promotion for this pack
     */
    public function activePromotion()
    {
        return $this->promotions()
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now())
            ->first();
    }

    /**
     * The orders that belong to the food pack.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_pack_alimentaire');
    }
}