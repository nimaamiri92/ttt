<?php

namespace App\Core\Validation\Constraints;

interface ValidationConstraintInterface
{
    public function isApplicable(string $name): bool;

    public function validate(string $value, array $rule): bool;

    public function getMessage(): string;
}
