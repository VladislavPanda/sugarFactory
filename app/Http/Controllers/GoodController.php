<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Good;

class GoodController extends Controller
{
    public function index(){
        // Получаем и преобразуем весь список товаров
        $goods = Good::all()->toArray();
        
        foreach($goods as $key => &$value){
            $value['images'] = json_decode($value['images'], true);
        }
        unset($value);
        
        return view('welcome')->with('goods', $goods);
    }

    public function show($id){
        dd($id);
    }
}
