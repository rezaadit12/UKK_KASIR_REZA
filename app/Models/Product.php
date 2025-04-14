<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use UUIDAsPrimaryKey;
    protected $guarded = ['id'];


    public function detailSale()
    {
        return $this->hasMany(DetailSale::class);
    }

}
