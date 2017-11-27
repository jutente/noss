<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordRequest extends FormRequest
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
          'password' => 'required|min:6',
          'newpassword' => 'required|min:6|confirmed',

        ];
    }

    public function messages(){
        return [
        'password.required' => 'Digite sua senha atual.',
        'password.min' => 'A senha deve ter no mínimo 6 caracteres.',

        'newpassword.required' => 'Digite sua nova senha.',
        'newpassword.min' => 'A senha deve ter no mínimo 6 caracteres.',
        'newpassword.confirmed' => 'Sua senha não foi confirmada corretamente.',

        ];
    } 

}
