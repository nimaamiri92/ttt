<?php

namespace App\Core\Validation\Constraints;

class MinimumCharacterConstraint implements ValidationConstraintInterface
{
    private const NAME = 'min';

    private string $message;

    public function isApplicable($name): bool
    {
        return self::NAME === $name;
    }

    public function validate(string $value, array $rule): bool
    {
        $min = $rule[1][1];
        if (!empty($value) && strlen($value) >= (int)$min) {
            return true;
        }

        $this->message = sprintf('Minimum length must not be less than %d', $min);
        return false;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
