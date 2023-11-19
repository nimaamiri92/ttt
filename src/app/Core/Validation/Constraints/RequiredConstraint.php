<?php

namespace App\Core\Validation\Constraints;

class RequiredConstraint implements ValidationConstraintInterface
{
    private const NAME = 'required';

    public function isApplicable($name): bool
    {
        return self::NAME === $name;
    }

    public function validate(string $value,array $rule):bool
    {
        return !empty($value);
    }

    public function getMessage(): string
    {
        return sprintf('This field is required');
    }
}
