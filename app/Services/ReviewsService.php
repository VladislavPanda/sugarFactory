<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReviewsService{

    public function makeReviewObjectRecord(&$reviewData){
        $reviewData['date'] = date('Y-m-d');

        $user = User::find(Auth::user()->id);
        $company = $user->company;
        $reviewData['company_name'] = $company->name;
    } 
}