<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Services\ReviewsService;

class ReviewController extends Controller
{
    private $reviewsService;

    public function __construct(ReviewsService $reviewsService){
        $this->reviewsService = $reviewsService;
    }

    public function create($goodId){
        return view('cabinet.order')->with('goodId', $goodId);
    }

    public function store(Request $request){
        $reviewData = $request->except(['_token']);

        
    }
}
