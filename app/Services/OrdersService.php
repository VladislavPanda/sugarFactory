<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Good;
use App\Models\Order;
use App\Models\Pack;

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

    // Сформировать список заказов
    public function makeOrdersList(){
        $ordersList = [];
        $userId = Auth::user()->id;

        $orders = Order::where('user_id', $userId)->get()->toArray();

        foreach($orders as $key => $value){
            $ordersList[$key]['id'] = $value['id'];

            $good = Good::select(['title', 'short_description'])->where('id', $value['good_id'])->get();
            $ordersList[$key]['good'] = $good[0]->title . ' ' . $good[0]->short_description;
            
            $pack = Pack::select(['weight', 'forma', 'group'])->where('id', $value['pack_id'])->get();
            $ordersList[$key]['pack'] = $pack[0]->weight . ' ' . $pack[0]->forma . ' ' . $pack[0]->group;
        
            $ordersList[$key]['quantity'] = $value['quantity'];

            // Обработка даты
            $ordersList[$key]['date'] = $value['date'];
            $ordersList[$key]['status'] = $value['status'];
        }
        dd($ordersList);
    }
}