<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Ownership implements ValidationRule
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $object = is_object($value) ? $value : (new $this->model)->findOrFail($value);

        if ($object->user_id !== auth('sanctum')->id()) {
            $fail('This object does not belong to you.');
        }
    }
}
