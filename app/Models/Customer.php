<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    Use UUIDAsPrimaryKey;
    protected $guarded = ['id'];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
