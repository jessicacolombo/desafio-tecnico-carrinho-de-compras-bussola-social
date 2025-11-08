<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StorePurchaseRequest extends FormRequest
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
            'products' => ['required', 'array', 'min:1'],
            'products.*.id' => ['required', 'integer', 'in:1,2,3,4,5'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'installments' => ['required', 'integer', 'min:1', 'max:12'],
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
            'products.required' => 'É obrigatório fornecer a lista de produtos.',
            'products.array' => 'A lista de produtos deve ser um array.',
            'products.min' => 'A lista de produtos deve conter pelo menos um produto.',
            'products.*.id.required' => 'O ID do produto é obrigatório.',
            'products.*.id.integer' => 'O ID do produto deve ser um número inteiro.',
            'products.*.id.in' => 'O produto com o ID fornecido não existe.',
            'products.*.quantity.required' => 'A quantidade do produto é obrigatória.',
            'products.*.quantity.integer' => 'A quantidade do produto deve ser um número inteiro.',
            'products.*.quantity.min' => 'A quantidade do produto deve ser pelo menos 1.',
            'products.*.quantity.max' => 'A quantidade do produto não pode exceder 12.',
            'payment_method.required' => 'O método de pagamento é obrigatório.',
            'payment_method.string' => 'O método de pagamento deve ser uma string.',
            'payment_method.enum' => 'O método de pagamento selecionado é inválido.',
            'installments.required' => 'O número de parcelas é obrigatório.',
            'installments.integer' => 'O número de parcelas deve ser um número inteiro.',
            'installments.min' => 'O número de parcelas deve ser pelo menos 1.',
            'installments.max' => 'O número de parcelas não pode exceder 12.',
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
            'products' => [
                'description' => 'Lista de produtos a serem comprados.',
                'example' => [
                    ['id' => 1, 'quantity' => 2],
                    ['id' => 3, 'quantity' => 1],
                ],
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
