<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Repository;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Color;
use App\Services\OrdersService;

class PlatformScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $ordersList = [];
        $ordersService = new OrdersService();
        $orders = $ordersService->makeOrdersList('admin');
        
        for($i = 0; $i < sizeof($orders); $i++){
            $ordersList[] = new Repository(['company_name' => $orders[$i]['company_name'],
                                            'good' => $orders[$i]['good'],
                                            'pack' => $orders[$i]['pack'],
                                            'quantity' => $orders[$i]['quantity'],
                                            'date' => $orders[$i]['date'],
                                            'status' => $orders[$i]['status'],
                                       ]);                           
        }

        return [
            'orders' => $ordersList
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список заказов';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    /*public function description(): ?string
    {
        return 'Welcome to your Orchid application.';
    }*/

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('orders', [
                TD::make('company_name', 'Компания')
                    ->width('70')
                    ->render(static function ($row){
                        return view('layouts.ordersText', ['data' => $row['company_name'], 'width' => 100]);
                    }),

                TD::make('good', 'Товар')
                    ->width('220')
                    ->render(static function ($row){
                        return view('layouts.ordersText', ['data' => $row['good'], 'width' => 250]);
                    }),

                TD::make('pack', 'Упаковка')
                    ->width('300')
                    ->render(static function ($row){
                        return view('layouts.ordersText', ['data' => $row['pack'], 'width' => 300]);
                    }),

                TD::make('quantity', 'Кол-во')
                    ->width('30')
                    ->render(static function ($row){
                        return view('layouts.ordersText', ['data' => $row['quantity'], 'width' => 70]);
                    }),

                TD::make('date', 'Дата')
                    ->width('60')
                    ->render(static function ($row){
                        return view('layouts.ordersText', ['data' => $row['date'], 'width' => 80]);
                    }),

                TD::make('status', 'Статус')
                    ->width('80')
                    ->render(static function ($row){
                        return view('layouts.ordersText', ['data' => $row['status'], 'width' => 100]);
                    }),
            ])
        ];
    }
}
