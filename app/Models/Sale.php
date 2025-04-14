<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use UUIDAsPrimaryKey;
    protected $guarded = ['id'];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailSale()
    {
        return $this->hasMany(DetailSale::class);
    }
}
