<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SODetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'soid', 'itemcode', 'itemname', 'qty', 'price', 'discount', 'total', 'sonumber', 'discperc'
    ];
}