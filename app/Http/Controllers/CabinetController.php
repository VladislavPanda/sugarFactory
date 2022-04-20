<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrdersService;
use App\Models\Good;
use App\Models\Order;
use App\Models\Pack;

class CabinetController extends Controller
{
    private $ordersService;

    public function __construct(OrdersService $ordersService){
        $this->ordersService = $ordersService;
    }

    public function index(){
        $orders = [];

        $this->ordersService->makeOrdersList();


        return view('cabinet.orders');
    }
}
