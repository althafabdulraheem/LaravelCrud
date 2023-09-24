<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table='property';
    protected $fillable=['name', 'slug', 'code', 'price', 'currency', 'description', 'inclusion_exclusion', 'created_at'];

    public function getFeclities()
    {
        return $this->hasOne('App\Models\PropertyFecility','property_id','id');
    }

    
}
