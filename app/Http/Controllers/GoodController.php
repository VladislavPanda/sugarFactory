<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Good;
use App\Models\Pack;
use App\Models\Review;
use App\Services\GoodsService;

class GoodController extends Controller
{
    private $goodsService;

    public function __construct(GoodsService $goodsService){
        $this->goodsService = $goodsService;
    }

    public function index(){
        // Получаем и преобразуем весь список товаров
        $goods = Good::all()->toArray();

        $this->goodsService->encodeImages($goods);
        
        return view('welcome')->with('goods', $goods);
    }

    public function show($id){
        $goodObj = Good::find($id);
        $good = $goodObj->toArray();
        $good['images'] = json_decode($good['images'], true);
        $packs = $goodObj->packs->toArray();
        $good['packs'] = $packs;

        $reviews = [];
        $reviews = Review::where('good_id', $id)->get()->toArray();
        
        return view('good')->with('good', $good)->with('reviews', $reviews);
    }

    public function goodForOrder(Request $request){
        $goodId = $request->input('good_id');

        //$good = Good::find($goodId);
        $packs = Good::with('packs')->find($goodId)->packs;

        return $packs;
    }
}
