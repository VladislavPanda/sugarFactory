<?php

namespace App\Services;

class OrdersService{
    // Парсинг строки упаковок к нужному формату
    public function parsePack($item){
        $item['pack'] = ' ' . $item['pack'];

        $ini = strpos($item['pack'], 'Вес');
        if ($ini == 0) return '';

        $ini += strlen('Вес');
        $len = strpos($item['pack'], 'Форма', $ini) - $ini;
        $weight = trim(substr($item['pack'], $ini, $len));

        return $weight;
    }
}