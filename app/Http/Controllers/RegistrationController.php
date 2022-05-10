<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Models\Company;

class RegistrationController extends Controller
{
    public function index(){
        return view('registration');
    }

    public function store(RegistrationRequest $request){
        $user = User::create(
                                [
                                 'name' => $request->input('client_name'), 
                                 'email' => $request->input('email'), 
                                 'password' => $request->input('password')
                                ]
                            );

        // Записываем данные в таблицу компаний-клиентов
        $company = Company::create(
                                    [
                                        'user_id' => $user->id, 
                                        'name' => $request->input('company_name'),
                                        'phone' => $request->input('phone')
                                    ]
                                  );
    
        return redirect()->route('cabinet.index');
    }   
}
