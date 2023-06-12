<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_price',
        'purchase_vat',
        'trade_price',
        'offer_price',
        'note',
        'wholesale_price',
        'trade_vat'
    ];


}
