<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'company_name' => 'required',
            'client_name' => 'required|alpha',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Поле "Email" является обязательным"',
            'company_name.required' => 'Поле "Название компании" является обязательным',
            'client_name.required' => 'Поле "Имя клиента" является обязательным',
            'password.required' => 'Поле пароля явлется обязательным',
            'password_confirm.required' => 'Поле подтверждения пароля является обязательным',
            'password_confirm.same' => 'Пароли не совпадают',
            'client_name.alpha' => 'Имя клиента не может содержать цифры'
        ];
    }
}
