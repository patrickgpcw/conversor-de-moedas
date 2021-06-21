<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public function scopeBase($query, $base)
    {
        return $query->where('base', $base);
    }

    public function scopeTo($query, $to)
    {
        return $query->where('to', $to);
    }
}
