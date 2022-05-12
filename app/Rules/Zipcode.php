<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class Zipcode implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Str::of($value)->upper()->match('/^([1-9][0-9]{3}[[:space:]]{0,1}(?!SA|SD|SS)[A-Z]{2})|(0000[[:space:]]{0,1}XX)$/')->isNotEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be valid dutch postalcode.';
    }
}
