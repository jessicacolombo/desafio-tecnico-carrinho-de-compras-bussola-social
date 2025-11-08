<?php

namespace App\Http\Requests\PaymentCalculation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StorePaymentCalculationRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação para a requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'integer', 'min:0'],
            'payment_method' => [
                'required',
                'string',
                new Enum(\App\Enums\PaymentMethods::class),
            ],
        ];
    }

    /**
     * Mensagens de erro personalizadas para as regras de validação.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'O valor é obrigatório.',
            'amount.integer' => 'O valor deve ser um número inteiro.',
            'amount.min' => 'O valor deve ser pelo menos 0.',
            'payment_method.required' => 'O método de pagamento é obrigatório.',
            'payment_method.string' => 'O método de pagamento deve ser uma string.',
            'payment_method.enum' => 'O método de pagamento selecionado é inválido.',
        ];
    }

    /**
     * Parâmetros do corpo da requisição para documentação.
     *
     * @return array<string, mixed>
     */
    public function bodyParameters(): array
    {
        return [
            'amount' => [
                'description' => 'Valor total da compra.',
                'example' => 150.75,
            ],
            'installments' => [
                'description' => 'Número de parcelas para o pagamento.',
                'example' => 3,
            ],
            'payment_method' => [
                'description' => 'Método de pagamento escolhido.',
                'example' => 'credit_card',
            ],
        ];
    }
}
