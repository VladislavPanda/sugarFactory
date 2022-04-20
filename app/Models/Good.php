<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'goods';
    protected $guarded = [];

    public function packs(){
        return $this->hasMany(Pack::class, 'good_id', 'id');
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
