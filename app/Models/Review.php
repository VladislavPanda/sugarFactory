<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reviews';
    protected $guarded = [];

    public function good(){
        return $this->hasOne(Good::class, 'good_id');
    }

    public function company(){
        return $this->hasOne(Company::class, 'company_id');
    }
}
