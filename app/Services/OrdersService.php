<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Good;
use App\Models\Order;
use App\Models\Pack;
use App\Models\User;
use App\Models\Company;

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
    public function makeOrdersList($role, $param){
        $ordersList = [];

        // Если сервис используется для клиента, то выводятся только его заказы, если для менеджера - то все заказы
        if($role == 'client'){
            $userId = Auth::user()->id;

            $orders = Order::where('user_id', $userId)->get()->toArray(); // Получение списка заказов
        }else if($role == 'admin'){
            
            if($param == null) $orders = Order::all()->toArray(); // Проверяем наличие параметра фильтрации. Если его нет, выводим все записи. 
            // Если параметр есть, определяем поле фильтрации и делаем выборку только нужных записей
            else if(isset($param['company_name'])){
                try{
                    $foreignUserId = Company::select('user_id')->where('name', $param['company_name'])->get()->toArray();
                    $orders = Order::where('user_id', $foreignUserId[0]['user_id'])->get()->toArray();
                }catch(\Exception $e){
                    return [];
                }
            }
        }
    
        foreach($orders as $key => $value){
            $ordersList[$key]['id'] = $value['id'];

            // Получение данных о товаре
            $good = Good::select(['id', 'title', 'short_description'])->where('id', $value['good_id'])->get();
            $ordersList[$key]['good'] = $good[0]->title . ' ' . $good[0]->short_description;
            $ordersList[$key]['good_id'] = $good[0]->id;

            // Получение данных об упаковке
            $pack = Pack::select(['weight', 'forma', 'group'])->where('id', $value['pack_id'])->get();
            $ordersList[$key]['pack'] = $pack[0]->weight . ' ' . $pack[0]->forma . ' ' . $pack[0]->group;
        
            $ordersList[$key]['quantity'] = $value['quantity'];

            // Обработка даты
            $date = explode('-', $value['date']);
            $date = $date[2] . '-' . $date[1] . '-' . $date[0];

            // Запись даты и статуса
            $ordersList[$key]['date'] = $date;
            $ordersList[$key]['status'] = $value['status'];

            // Если администратор, получаем данные о компании
            if($role == 'admin'){
                $user = User::find($value['user_id']);
                $company = $user->company;
                $ordersList[$key]['company_name'] = $company->name;
            }
        }
        
        return $ordersList;
    }
}