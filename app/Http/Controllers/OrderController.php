<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OrdersService;
use App\Models\Order;
use App\Models\Good;
use App\Models\Pack;

class OrderController extends Controller
{
    private $ordersService;

    public function __construct(OrdersService $ordersService){
        $this->ordersService = $ordersService;
    }

    public function store(Request $request){
        $order = [];
        $item = $request->except(['_token']);

        $weight = $this->ordersService->parsePack($item);

        $packId = Pack::select('id')->where([['good_id', $request->input('good_id')], ['weight', $weight]])->get()->toArray();
        $packId = $packId[0]['id'];

        $order['user_id'] = Auth::user()->id;
        $order['good_id'] = $request->input('good_id');
        $order['pack_id'] = $packId;
        $order['quantity'] = $request->input('quantity');

        Order::create($order);

        return true;
    }
}
