<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    protected $guarded = [];

    public function good(){
        return $this->hasOne(Order::class, 'good_id');
    }

    public function pack(){
        return $this->hasOne(Pack::class, 'pack_id');
    }
}
