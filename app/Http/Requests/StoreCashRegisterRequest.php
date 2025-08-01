<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCashRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => 'required|exists:services,id',
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'payment_type' => 'required|string',
            'status' => 'required|in:em_aberto,pago',
            'payment_date' => 'required|date',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'service_id.required' => 'O serviço é obrigatório.',
            'service_id.exists' => 'O serviço selecionado não existe.',
            'client_id.required' => 'O cliente é obrigatório.',
            'client_id.exists' => 'O cliente selecionado não existe.',
            'amount.required' => 'O valor é obrigatório.',
            'amount.numeric' => 'O valor deve ser um número.',
            'amount.min' => 'O valor deve ser maior ou igual a zero.',
            'payment_type.required' => 'O tipo de pagamento é obrigatório.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status deve ser "em_aberto" ou "pago".',
            'payment_date.required' => 'A data de pagamento é obrigatória.',
            'payment_date.date' => 'A data de pagamento deve ser uma data válida.',
        ];
    }
}
