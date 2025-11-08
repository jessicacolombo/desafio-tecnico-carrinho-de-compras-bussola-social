<template>
  <div v-if="closedPurchase && closedPurchase.payment" class="container mx-auto p-6 max-w-2xl">
    <div class="bg-white rounded-lg shadow-lg p-6">
      <div class="text-center mb-6">
        <div class="bg-green-600 text-white rounded-full mx-auto w-[50px] h-[50px] text-5xl mb-5">✓</div>
        <h1 class="text-2xl font-bold text-gray-800">Compra Finalizada!</h1>
        <p class="text-gray-600">Seu pedido foi realizado com sucesso</p>
      </div>

      <div class="space-y-3">
        <h2 class="font-semibold text-lg">Detalhes do Pagamento</h2>

        <div class="flex justify-between text-gray-700">
          <span>Método:</span>
          <span class="font-medium">{{
            getPaymentMethodLabel(closedPurchase.payment_method)
          }}</span>
        </div>

        <div class="flex justify-between text-gray-700">
          <span>Subtotal:</span>
          <span>R$ {{ closedPurchase.payment.amount.formatted }}</span>
        </div>

        <div class="flex justify-between text-green-600">
          <span>Desconto:</span>
          <span>- R$ {{ closedPurchase.payment.discount.formatted }}</span>
        </div>

        <div class="flex justify-between text-gray-700">
          <span>Taxas:</span>
          <span>R$ {{ closedPurchase.payment.taxes.formatted }}</span>
        </div>

        <div class="flex justify-between text-xl font-bold text-gray-900 pt-3 border-t">
          <span>Total:</span>
          <span>R$ {{ closedPurchase.payment.total.formatted }}</span>
        </div>

        <div v-if="closedPurchase.payment.installments > 1" class="text-right text-gray-600 pt-2">
          {{ closedPurchase.payment.installments }}x de R$
          {{ closedPurchase.payment.installmentValue.formatted }}
        </div>
      </div>

      <div class="mt-6 flex gap-3">
        <button
          @click="router.push('/products')"
          class="flex-1 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition"
        >
          Continuar Comprando
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { storeToRefs } from 'pinia'
import { useCartStore } from '@/stores/cart'
import { useToast } from 'vue-toast-notification'
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'

const router = useRouter()
const cartStore = useCartStore()
const { closedPurchase } = storeToRefs(cartStore)
const $toast = useToast()

onMounted(() => {
  if (!closedPurchase.value || !closedPurchase.value.payment) {
    $toast.warning('Nenhuma compra encontrada!')
    router.push('/products')
  }
})

const getPaymentMethodLabel = (method) => {
  const methods = {
    credit_card: 'Cartão de Crédito',
    pix: 'PIX',
    debit_card: 'Cartão de Débito',
  }
  return methods[method] || method
}
</script>
