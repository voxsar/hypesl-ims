<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAppointment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' => 'required|string',
            'start' => 'required|date_format:Y/m/d H:i',
            'end' => 'required_if:allday,1|date_format:Y/m/d H:i|after:start',
            'repeat_until' => 'nullable|date_format:Y/m/d|after:start',
            'allday' => 'required|boolean',
            'url' => 'nullable|url',
            'starteditable' => 'required|boolean',
            'durationeditable' => 'required|boolean',
            'resourceeditable' => 'required|boolean',
            'overlap' => 'required|boolean',
            'display' => 'required|in:block,list-item,background,auto',
            'appointment_additional' => 'nullable',
            'appointment_color' => 'required|exists:appointment_colors,id',
            'appointment_text_color' => 'required|exists:appointment_colors,id',
            'appointment_type' => 'required|exists:appointment_types,id',
            'appointment_constraint' => 'nullable|exists:appointment_constraints,id',
            'description' => 'nullable|string',
            'dayofweek' => 'nullable|array',
        ];
    }
}
