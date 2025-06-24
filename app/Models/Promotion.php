<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'pack_alimentaire_id',
        'prix_promotionnel',
        'date_debut',
        'date_fin',
    ];

    public function packAlimentaire()
    {
        return $this->belongsTo(PackAlimentaire::class);
    }
}
