<?php

namespace App\Rules;

use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TimeHorarioRange implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $hora_salida;

    public function __construct($hora_salida)
    {
        $this->hora_salida = $hora_salida;
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
        $horario = Horario::whereTime('hora_entrada','<=', $value)->whereTime('hora_salida', '>=', $value)->first();
        if(@$this->hora_salida){
            $horario = Horario::whereBetween('hora_entrada', [$value, $this->hora_salida])
                ->orWhereBetween('hora_salida', [$value, $this->hora_salida])
                ->first();
        }
        return !$horario;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'el rango es invalido o ya ha sido usado';
    }
}
