<?php

namespace App\Services;

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
}