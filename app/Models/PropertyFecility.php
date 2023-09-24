<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFecility extends Model
{
    use HasFactory;
    protected $table='property_fecility';
    protected $fillable=['property_id', 'faciities', 'status', 'created_at'];
}
