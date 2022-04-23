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

class PlatformScreen extends Screen
{
    private $param;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $ordersList = [];
        $ordersService = new OrdersService();

        /*Проверка на сортировку/фильтрацию
        Если параметры отсутствуют, применяется вывод по умолчанию
        Если параметр присутствует (дата или название компании), готовим вывод по нему */

        if(empty($_GET)){ 
            $param = null;
            $this->param = null;
        }else if(isset($_GET['company_name']) || isset($_GET['date'])){
            $param = $_GET;
            $this->param = $param;
        }

        //dd($_GET);
        $orders = $ordersService->makeOrdersList('admin', $param);
        
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
                                        'status' => 'Новый заказ'
                                    ]),

                                Button::make('Ожидает подтверждения')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'status' => 'Ожидает подтверждения'
                                    ]),

                                Button::make('Подтверждён')
                                    ->method('setStatus')
                                    ->icon('clock')
                                    ->parameters([
                                        'status' => 'Подтверждён'
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

    /*public function sort(Request $request){
        $sortData = $request->except(['_token']);

        if(!isset($sortData['current_param'])){
            return redirect()->route('platform.main', ['sort' => $sortData['sortParam']]);
        }else{
            return redirect()->route('platform.main', ['sort' => $sortData['sortParam']]);
        }
    }*/

    public function setStatus(Request $request){

    }
}
