<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackScolaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'contenu',
        'prix',
        'image',
        'tag',
        'niveau_scolaire',
    ];

    public function promotions()
    {
        return $this->hasMany(Promotion::class, 'pack_scolaire_id');
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
     * The orders that belong to the school pack.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_pack_scolaire');
    }
}
