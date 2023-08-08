<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationService
{
    public function addUserValid($request)
    {
        $messages = [
            'required' => 'Необходимо заполнить поле',
            'username.min' => 'Минимальное количество символов 3',
            'email' => 'Не корректно заполнен email',
            'email.unique' => 'Указанный email не уникален',
            'password.min' => 'Минимальное количество символов 8',
            'image' => 'Файл должен быть картинкой',
            'img.mimes' => 'Поддерживаемые MIME файла (image/jpeg, image/png)',
        ];

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
            'img' => ['image', 'mimes:jpeg, png'],
        ], $messages);

        return $validator;
    }
}