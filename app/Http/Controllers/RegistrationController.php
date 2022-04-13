<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;

class RegistrationController extends Controller
{
    public function store(RegistrationRequest $request){
        dd($request->all());
    }   
}
