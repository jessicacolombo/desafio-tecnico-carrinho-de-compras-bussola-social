<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentCalculation\StorePaymentCalculationRequest;
use App\Services\PaymentMethod\CreditCardPaymentService;
use App\Services\PaymentMethod\PixPaymentService;

class PaymentCalculationController extends Controller
{
    /**
     * Calcula as opções de pagamento com base no método selecionado.
     *
     * @group Pagamento
     * @responseFile storage/scribe/responses/PaymentCalculationController/calculate.json
     */
    public function calculate(StorePaymentCalculationRequest $request)
    {
        $validated = $request->validated();

        $amount = $validated['amount'];
        $paymentMethod = $validated['payment_method'];

        if ($paymentMethod === 'pix') {
            return $this->calculatePix($amount);
        }

        return $this->calculateCreditCard($amount, $validated['installments'] ?? null);
    }

    private function calculatePix(float $amount)
    {
        $pixService = new PixPaymentService();
        $payment = $pixService->processPayment($amount, 1);

        return response()->json([
            'payment_method' => 'pix',
            'original_amount' => $payment->amount->value,
            'options' => [
                [
                    'installments' => 1,
                    'installment_value' => $payment->total->value,
                    'taxes' => $payment->taxes->value,
                    'discount' => $payment->discount->value,
                    'total_amount' => $payment->total->value,
                ]
            ],
        ]);
    }

    private function calculateCreditCard(float $amount, ?int $requestedInstallments)
    {
        $options = [];
        for ($i = 1; $i <= 12; $i++) {
            $creditCardService = new CreditCardPaymentService();
            $payment = $creditCardService->processPayment($amount, $i);

            $options[] = [
                'installments' => $payment->installments,
                'installment_value' => $payment->installmentValue->value,
                'taxes' => $payment->taxes->value,
                'discount' => $payment->discount->value,
                'total_amount' => $payment->total->value,
            ];
        }

        return response()->json([
            'payment_method' => 'credit_card',
            'original_amount' => $amount,
            'options' => $options,
        ]);
    }
}
