<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => 'nullable|in:Pending,Accepted,Rejected',
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'El estado debe ser uno de los siguientes: Pendiente, Aceptado, Rechazado.',
        ];
    }
}
