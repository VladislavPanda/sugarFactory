<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Good;
use App\Models\Order;
use App\Models\Pack;
use App\Models\User;
use App\Models\Company;

class OrdersService{
    private const CHAT_ID = '491966622'; //'1498713091';
    private const TOKEN = '5363947644:AAFRqufLBfamyhEq65CW2cqJPtjvKrax2jE';

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
            else if(isset($param['company_name'])){ // Если параметр - название компании
                try{
                    // Определяем id пользователя, связанного с компанией
                    $foreignUserId = Company::select('user_id')->where('name', $param['company_name'])->get()->toArray();
                    $orders = Order::where('user_id', $foreignUserId[0]['user_id'])->get()->toArray();
                }catch(\Exception $e){
                    return [];
                }
            }
            else if(isset($param['date'])){ // Если параметр - дата
                try{
                    $orders = Order::where('date', $param['date'])->get()->toArray();
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

    public function sort(&$orders, $param){
        if($param == 'date'){
            usort($orders, function($x, $y) {
                return $x['date'] <=> $y['date'];
            });
        }

        if($param == 'company_name'){
            usort($orders, function($x, $y) {
                return $x['company_name'] <=> $y['company_name'];
            });
        }
    }

    public function telegram($order){
        $message = $this->createMessage($order);
        $this->sendMessage($message);
    }

    // Отправить сообщение
    public function sendMessage($messaggio){
        $url = "https://api.telegram.org/bot" . OrdersService::TOKEN . "/sendMessage?chat_id=" . OrdersService::CHAT_ID;
        $url = $url . "&text=" . urlencode($messaggio);
        $ch = curl_init();
        $optArray = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    // Сформировать текст сообщения:
    public function createMessage($order){
        $telegramMessage = 'Новый заказ: ' . "\n";
        $telegramMessage .= '-------------------------------------------------------------' . "\n";
        
        $userData = User::select(['name', 'email'])->where('id', $order['user_id'])->get();
        $telegramMessage .= 'Имя клиента: ' . $userData[0]->name . "\n";
        $telegramMessage .= 'Email: ' . $userData[0]->email . "\n";
        $telegramMessage .= '-------------------------------------------------------------' . "\n"; 
        
        $goodData = Good::find($order['good_id'])->get();
        $telegramMessage .= 'Товар: ' . $goodData[0]->title . ' ' . $goodData[0]->short_description . ' ' . $goodData[0]->forma . "\n";
        
        $packData = Pack::find($order['pack_id'])->get();
        $telegramMessage .= 'Упаковка: ' . $packData[0]->weight . ' ' . $packData[0]->forma . ' ' . $packData[0]->group . "\n";
        $telegramMessage .= 'Количество: ' . $order['quantity'] . "\n";
        $telegramMessage .= '-------------------------------------------------------------' . "\n";

        return $telegramMessage;
    }
}