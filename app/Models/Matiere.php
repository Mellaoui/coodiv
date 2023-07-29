<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matiere extends Model
{
    use HasFactory;

    // -- Properties -- //

    protected $guarded = [];

    // -- Has-Many Relationships -- //

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
