<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_phone',
        'delivery_address',
        'total_price',
        'status',
        'order_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'order_date' => 'date',
    ];

    /**
     * The food packs that belong to the order.
     */
    public function packAlimentaires()
    {
        return $this->belongsToMany(PackAlimentaire::class, 'order_pack_alimentaire');
    }
    //
}
