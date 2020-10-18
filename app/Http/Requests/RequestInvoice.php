<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestInvoice extends FormRequest
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
            'invoice_no' => 'required|unique:invoices,invoice_no|string',
            'date' => 'required|after_or_equal:today|date_format:Y/m/d H:i',
            'due_date' => 'nullable|after:date|date_format:Y/m/d H:i',
            'terms' => 'nullable|',
            'memo' => 'required|string',
            'invoice_dynamic' => 'array|required',
            'invoice_dynamic.*.memo' => 'required|string',
            'invoice_dynamic.*.account_id.*' => 'required|string',
            'invoice_dynamic.*.amount.*' => 'required|numeric',
            'invoiceedit_dynamic' => 'array',
            'invoiceedit_dynamic.*.memo' => 'required|string',
            'invoiceedit_dynamic.*.account_id.*' => 'required|string',
            'invoiceedit_dynamic.*.amount.*' => 'required|numeric',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'invoice_dynamic' => 'The invoice must have at least one invoice line',
            'invoiceedit_dynamic.*.description.required' => 'The invoice line must not be empty',
            'invoiceedit_dynamic.*.type.required' => 'The invoice line type must not be empty',
            'invoiceedit_dynamic.*.quantity.numeric' => 'The invoice quantity must be a number',
            'invoiceedit_dynamic.*.rate.numeric' => 'The invoice rate must be a number',
            'invoiceedit_dynamic.*.amount.numeric' => 'The invoice amount must be a number',
            'invoiceedit_dynamic.*.quantity.required' => 'The invoice quantity is required',
            'invoiceedit_dynamic.*.rate.required' => 'The invoice rate is required',
            'invoiceedit_dynamic.*.amount.required' => 'The invoice amount is required',
        ];
    }
}
