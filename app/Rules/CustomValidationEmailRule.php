<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomValidationEmailRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $arroba = explode('@', $value);
        $punto = explode('.', $arroba[1]);
        if (!isset($punto[1])) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the :attribute must have ".com" at the end.';
    }
}
