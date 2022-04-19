<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pack extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'packs';
    protected $guarded = [];

    public function good(){
        return $this->belongsTo(Good::class, 'good_id', 'id');
    }
}
