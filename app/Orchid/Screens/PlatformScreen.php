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
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Repository;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Color;
use App\Services\OrdersService;
use App\Http\Controllers\OrderController;

class PlatformScreen extends Screen
{
    private $param;
    private const STATUSES = [
        'Новый заказ' => 'Новый заказ',
        'Ожидает подтверждения' => 'Ожидает подтверждения',
        'Подтверждён' => 'Подтверждён',
        'Собирается' => 'Собирается',
        'Собран' => 'Собран',
        'Готов к отгрузке' => 'Готов к отгрузке',
        'Отгружен' => 'Отгружен',
        'Доставлен' => 'Доставлен',
        'Возврат' => 'Возврат',
        'Отменен' => 'Отменен',
        'Оплачен' => 'Оплачен',
        'Не оплачен' => 'Не оплачен'
    ];

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $ordersList = [];
        $ordersService = new OrdersService();

        /*
        Проверка на сортировку/фильтрацию
        Если параметры отсутствуют, применяется вывод по умолчанию
        Если параметр присутствует (дата или название компании), готовим вывод по нему 
        */

        if(empty($_GET)){ 
            $param = null;
            $this->param = null;

            $orders = $ordersService->makeOrdersList('admin', $param);
        }else if(isset($_GET['company_name']) || isset($_GET['date']) || isset($_GET['status'])){ // Если есть параметр фильтрации
            $param = $_GET;
            $this->param = $param;

            if(isset($_GET['sort'])){ // Если есть также параметр сортировки
                $sortParam = $_GET['sort'];
                $orders = $ordersService->makeOrdersList('admin', $param);

                $ordersService->sort($orders, $sortParam);
            }else{
                $orders = $ordersService->makeOrdersList('admin', $param);
            } 
        }else if(isset($_GET['sort'])){ // Если есть только парамeтр сортировки 
            $param = null;
            $sortParam = $_GET['sort'];
            $orders = $ordersService->makeOrdersList('admin', $param);

            $ordersService->sort($orders, $sortParam);
        }

        //$orders = $ordersService->makeOrdersList('admin', $param);
        
        for($i = 0; $i < sizeof($orders); $i++){
            $ordersList[] = new Repository(['id' => $orders[$i]['id'],
                                            'company_name' => $orders[$i]['company_name'],
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
            Layout::columns([
                Layout::rows([
                    Group::make([
                        ModalToggle::make('Фильтрация по дате')
                                    ->type(Color::PRIMARY())
                                    ->modal('filter_date_modal')
                                    //->canSee($this->checkProjectExistance($this->project))
                                    ->method('filterDate'),

                        ModalToggle::make('Фильтрация по названию компании')
                                    ->type(Color::PRIMARY())
                                    ->modal('filter_company_name_modal')
                                    //->canSee($this->checkProjectExistance($this->project))
                                    ->method('filterCompanyName'),

                        ModalToggle::make('Фильтрация по статусу')
                                    ->type(Color::PRIMARY())
                                    ->modal('filter_status_modal')
                                    //->canSee($this->checkProjectExistance($this->project))
                                    ->method('filterStatus'),

                        DropDown::make('Сортировка')
                            ->icon('folder-alt')
                            ->list([
                                Button::make('Дата')
                                    ->method('sort')
                                    ->icon('clock')
                                    ->parameters([
                                        'current_param' => $this->param,
                                        'sortParam' => 'date'
                                    ]),

                                Button::make('Название компании')
                                    ->method('sort')
                                    ->icon('building')
                                    ->parameters([
                                        'current_param' => $this->param,
                                        'sortParam' => 'company_name'
                                    ]),

                                Button::make('Статус')
                                    ->method('sort')
                                    ->icon('badge')
                                    ->parameters([
                                        'current_param' => $this->param,
                                        'sortParam' => 'status'
                                    ]),
                            ]),
                    ])->autowidth()
                ])
            ]),
            
            Layout::table('orders', [
                TD::make('company_name', 'Компания')
                    ->width('70')
                    ->render(static function ($row){
                        return view('layouts.ordersText', ['data' => $row['company_name'], 'width' => 100]);
                    }),

                TD::make('good', 'Товар')
                    ->width('200')
                    ->render(static function ($row){
                        return view('layouts.ordersText', ['data' => $row['good'], 'width' => 250]);
                    }),

                TD::make('pack', 'Упаковка')
                    ->width('250')
                    ->render(static function ($row){
                        return view('layouts.ordersText', ['data' => $row['pack'], 'width' => 300]);
                    }),

                TD::make('quantity', 'Кол-во')
                    ->width('10')
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

                TD::make('', '')
                    //->width('200')
                    ->render(function (Repository $repo) {
                        return Group::make([
                            DropDown::make('Изменить статус')
                            ->icon('folder-alt')
                            ->list([
                                Button::make('Новый заказ')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Новый заказ'
                                    ]),

                                Button::make('Ожидает подтверждения')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Ожидает подтверждения'
                                    ]),

                                Button::make('Подтверждён')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Подтверждён'
                                    ]),

                                Button::make('Собирается')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Собирается'
                                    ]),

                                Button::make('Собран')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Собран'
                                    ]),

                                Button::make('Готов к отгрузке')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Готов к отгрузке'
                                    ]),

                                Button::make('Отгружен')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Отгружен'
                                    ]),

                                Button::make('Доставлен')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Доставлен'
                                    ]),

                                Button::make('Возврат')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Возврат'
                                    ]),

                                Button::make('Отменен')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Отменен'
                                    ]),

                                Button::make('Оплачен')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Оплачен'
                                    ]),

                                Button::make('Не оплачен')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'id' => $repo->get('id'),
                                        'status' => 'Не оплачен'
                                    ]),
                            ]),
                        ]);
                    }
                )
            ]),

            Layout::modal('filter_date_modal', Layout::rows([
                DateTimer::make('date')
            ]))->title('Выберите дату')->applyButton('Фильтровать')->closeButton('Закрыть'),

            Layout::modal('filter_company_name_modal', Layout::rows([
                Input::make('company_name')->type('text')
            ]))->title('Введите название компании')->applyButton('Фильтровать')->closeButton('Закрыть'),

            Layout::modal('filter_status_modal', Layout::rows([
                Select::make('status')
                        ->title('Статус')
                        ->options(PlatformScreen::STATUSES),
            ]))->title('Введите статус')->applyButton('Фильтровать')->closeButton('Закрыть'),
        ];
    }

    public function filterDate(Request $request){
        $date = $request->input('date');
        return redirect()->route('platform.main', ['date' => $date]);
    }

    public function filterCompanyName(Request $request){
        $companyName = $request->input('company_name');
        return redirect()->route('platform.main', ['company_name' => $companyName]);
    }

    public function filterStatus(Request $request){
        $status = $request->input('status');
        return redirect()->route('platform.main', ['status' => $status]);
    }

    public function sort(Request $request){
        $sortData = $request->except(['_token']);

        if(isset($sortData['current_param'])){ 
            $filterParam = key($sortData['current_param']);
            $filterValue = $sortData['current_param'][$filterParam];
        }

        if(!isset($sortData['current_param'])){
            return redirect()->route('platform.main', ['sort' => $sortData['sortParam']]);
        }else{
            return redirect()->route('platform.main', [$filterParam => $filterValue, 'sort' => $sortData['sortParam']]);
        }
    }

    public function setStatus(Request $request){
        $statusData = $request->except(['_token']);

        $ordersService = new OrdersService();
        $controller = new OrderController($ordersService);
        $controller->updateStatus($statusData);
    }
}