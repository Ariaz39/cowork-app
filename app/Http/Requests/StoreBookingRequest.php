<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'workspace_id' => 'required|exists:workspaces,id',
            'booking_date_time' => 'required|date|after:now',
        ];
    }

    public function messages()
    {
        return [
            'workspace_id.required' => 'El espacio de trabajo es obligatorio.',
            'workspace_id.exists' => 'El espacio de trabajo seleccionado no existe.',
            'booking_date_time.required' => 'La fecha y hora de la reserva son obligatorias.',
            'booking_date_time.date' => 'La fecha y hora de la reserva deben ser una fecha válida.',
            'booking_date_time.after' => 'La fecha y hora de la reserva deben ser en el futuro.',
        ];
    }
}
