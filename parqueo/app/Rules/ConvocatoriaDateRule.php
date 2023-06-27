<?php

namespace App\Rules;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ConvocatoriaDateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $fecha_fin;

    public function __construct($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;
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
        $announcement = Announcement::whereDate('fecha_inicio','<=', $value)->whereDate('fecha_fin', '>=', $value)->first();
        if(@$this->fecha_fin){
            $startDate = Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $this->fecha_fin)->endOfDay();
            $announcement = Announcement::whereBetween('fecha_inicio', [$startDate, $endDate])
                ->orWhereBetween('fecha_fin', [$startDate, $endDate])
                ->first();
        }
        return !$announcement;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Rango de fecha invalido';
    }
}
