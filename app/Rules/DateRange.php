<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateRange implements Rule
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
        // Pisahkan nilai menjadi dua bagian: nilai awal dan nilai akhir
        [$start, $end] = explode(' - ', $value);

        // Lakukan pengecekan apakah nilai awal sama dengan nilai akhir
        return $start != $end;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute range is invalid.';
    }
}
