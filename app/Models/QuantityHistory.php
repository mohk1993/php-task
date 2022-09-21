<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuantityHistory extends Model
{
    use HasFactory;

         /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'type',
        'old_quantity',
        'new_quantity',
    ];
}
