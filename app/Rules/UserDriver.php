<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserDriver implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       $isDriver = User::where('id', $value)->where('role', 'driver')->exists();

       if (!$isDriver) {
            $fail('User is not a driver');
        }
    }
}
