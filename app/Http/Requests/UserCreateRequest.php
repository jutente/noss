<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
          'name' => 'required',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|min:6|confirmed',
          'perfil_id' => 'required'
        ];
    }

    public function messages(){
        return [
        'name.required' => 'Digite seu nome.',
        'email.required' => 'Digite seu e-mail.',
        'email.email' => 'E-mail inválido.',
        'password.required' => 'Digite uma senha.',
        'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
        'password.confirmed' => 'Sua senha não foi confirmada corretamente.',
        'email.unique' => 'Já existe um usuário com esse e-mail.',
        'perfil_id.required' => 'Selecione um perfil na lista.'
        ];
    }  
}
