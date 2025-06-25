<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'pack_alimentaire_id',
        'pack_scolaire_id',
        'type_pack',
        'prix_promotionnel',
        'date_debut',
        'date_fin',
    ];

    public function packAlimentaire()
    {
        return $this->belongsTo(PackAlimentaire::class);
    }

    public function packScolaire()
    {
        return $this->belongsTo(PackScolaire::class);
    }

    /**
     * Get the pack (alimentaire or scolaire) associated with this promotion
     */
    public function pack()
    {
        if ($this->type_pack === 'scolaire') {
            return $this->packScolaire();
        }
        return $this->packAlimentaire();
    }

    /**
     * Get the pack name
     */
    public function getPackNameAttribute()
    {
        if ($this->type_pack === 'scolaire' && $this->packScolaire) {
            return $this->packScolaire->nom;
        }
        if ($this->packAlimentaire) {
            return $this->packAlimentaire->nom;
        }
        return 'Pack non trouvé';
    }

    /**
     * Get the original pack price
     */
    public function getOriginalPriceAttribute()
    {
        if ($this->type_pack === 'scolaire' && $this->packScolaire) {
            return $this->packScolaire->prix;
        }
        if ($this->packAlimentaire) {
            return $this->packAlimentaire->prix;
        }
        return 0;
    }
}
