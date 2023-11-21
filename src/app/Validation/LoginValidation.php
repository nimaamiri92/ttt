<?php

namespace App\Validation;

use App\Core\Validation\ValidationAggregator;

class LoginValidation extends ValidationAggregator
{
    public function rules(): array
    {
        return [
            'username' => ['required',['min',6]],
            'password' => ['required',['max',5]],
        ];
    }
}
