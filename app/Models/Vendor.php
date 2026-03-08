<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['user_id', 'store_name', 'store_slug', 'description', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
