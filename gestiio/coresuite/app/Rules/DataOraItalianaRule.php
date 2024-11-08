<?php

namespace App\Rules;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Contracts\Validation\Rule;

class DataOraItalianaRule implements Rule
{
    protected $errorMessage;

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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $data = Carbon::createFromFormat('d/m/Y H:i', $value);
        } catch (InvalidFormatException $e) {
            $this->errorMessage = 'Il formato della data non è corretto';
            return false;
        }

        return true;

        if ($data->isPast()) {
            return true;
        } else {
            $this->errorMessage = 'La data deve essere nel passato.';
            return false;

        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage;
    }
}
