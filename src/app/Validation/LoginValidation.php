<?php

namespace App\Validation;

use App\Core\Validation\ValidationAggregator;

class LoginValidation extends ValidationAggregator
{
    public function rules(): array
    {
        return [
            'username' => ['required'],
            'password' => ['required'],
        ];
    }
}
