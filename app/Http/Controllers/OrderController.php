<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OrdersService;
use App\Services\GoodsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;
use App\Notifications\TelegramNotification;
use App\Models\Order;
use App\Models\Good;
use App\Models\Pack;
use App\Models\User;

class OrderController extends Controller
{
    private $ordersService;
    private $goodsService;

    public function __construct(OrdersService $ordersService, GoodsService $goodsService){
        $this->ordersService = $ordersService;
        $this->goodsService = $goodsService;
    }

    public function store(Request $request){
        $order = [];
        $item = $request->except(['_token']);

        $weight = $this->ordersService->parsePack($item);

        $packId = Pack::select('id')->where([
                                                ['good_id', $request->input('good_id')], 
                                                ['weight', $weight]
                                            ])->get()->toArray();
        $packId = $packId[0]['id'];

        $order['user_id'] = Auth::user()->id;
        $order['good_id'] = $request->input('good_id');
        $order['pack_id'] = $packId;
        $order['quantity'] = $request->input('quantity');
        $order['date'] = date('Y-m-d');
        $order['status'] = 'Новый заказ';

        $this->ordersService->telegram($order);

        Order::create($order);

        return redirect()->route('cabinet.index');
    }

    public function updateStatus($statusData){
        $item = Order::find($statusData['id']);
        $item->update(['status' => $statusData['status']]);
    }

    public function oneClick($id){
        $packs = $this->goodsService->getPacks($id);
        return view('oneClick')->with('goodId', $id)->with('packs', $packs);
    }
}
