<?php

namespace App\Services;

use App\Models\Good;

class GoodsService{
    // Преобразование json из базы к массиву
    public function encodeImages(&$goods){
        foreach($goods as $key => &$value){
            $value['images'] = json_decode($value['images'], true);
        }
        unset($value);

        return $goods;
    }

    // Получение id товара из пришедшей строки
    public function getId($value){
        $value = explode('№', $value);
        $goodId = $value[1];

        return $goodId;
    }

    public function getPacks($id){
        $packs = [];
        $good = Good::find($id);
        
        foreach($good->packs as $key => $value){
            $packs[] = 'Вес ' . $value->weight . ' Форма ' . $value->forma;
        }
        
        return $packs;
    }
}