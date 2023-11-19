<?php

namespace App\Core\Validation\Constraints;

class MaximumCharacterConstraint implements ValidationConstraintInterface
{
    private const NAME = 'max';

    private string $message;

    public function isApplicable($name): bool
    {
        return self::NAME === $name;
    }

    public function validate(string $value, array $rule): bool
    {
        $max = $rule[1][1];
        if (!empty($value) && strlen($value) <= (int)$max) {
            return true;
        }

        $this->message = sprintf('Maximum length must not be less than %d', $max);
        return false;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
