<?php

namespace App\Core\Validation;

use App\Application;
use App\Core\Request;
use App\Core\Validation\Constraints\MaximumCharacterConstraint;
use App\Core\Validation\Constraints\MinimumCharacterConstraint;
use App\Core\Validation\Constraints\RequiredConstraint;
use App\Core\Validation\Constraints\ValidationConstraintInterface;

abstract class ValidationAggregator
{
    /** @var $rules ValidationConstraintInterface[] */
    private array $validationConstraintList;
    private Request $request;

    private array $errorList = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->validationConstraintList = [
            new RequiredConstraint(),
            new MinimumCharacterConstraint(),
            new MaximumCharacterConstraint()
        ];
    }

    abstract public function rules(): array;

    public function validate(): self
    {
        foreach ($this->rules() as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $ruleName = is_array($rule) ? $rule[0] : $rule;
                foreach ($this->validationConstraintList as $constraint) {
                    if (!$constraint->isApplicable($ruleName)) {
                        continue;
                    }

                    if (!$constraint->validate($this->request->getAttribute($field), $fieldRules)) {
                        $this->errorList[$field][] = $constraint->getMessage();
                    }
                }
            }
        }

        return $this;
    }

    public function requestHasError(): bool
    {
        return (bool) count($this->errorList);
    }
    public function hasError($field): array|bool
    {
        return $this->errorList[$field] ?? false;
    }

    public function getErrors($field):array
    {
        return $this->errorList[$field];
    }
}
