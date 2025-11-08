<template>
  <div class="w-full max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-white mb-8">Finalizar Compra</h1>

    <div class="bg-white rounded-lg shadow-lg p-6 md:p-8">
      <div class="mb-8 pb-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Resumo do Pedido</h2>
        <div class="space-y-2">
          <div class="flex justify-between text-gray-600">
            <span>Total de itens:</span>
            <span class="font-medium">{{ cartStore.totalItems }}</span>
          </div>
          <div class="flex justify-between text-2xl font-bold text-gray-800">
            <span>Total:</span>
            <span class="text-green-600">{{ cartStore.formatPrice(totalPrice / 100) }}</span>
          </div>
        </div>
      </div>

      <form @submit.prevent="handleCheckout" class="space-y-6">
        <div>
          <label for="paymentMethod" class="block text-sm font-medium text-gray-700 mb-2">
            Método de Pagamento
          </label>
          <select
            id="paymentMethod"
            v-model="paymentMethod"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-800"
            required
          >
            <option value="">Selecione um método</option>
            <option value="credit_card">Cartão de Crédito</option>
            <option value="pix">PIX</option>
          </select>
        </div>

        <div v-if="paymentMethod">
          <label for="installments" class="block text-sm font-medium text-gray-700 mb-2">
            Parcelas
          </label>
          <select
            id="installments"
            v-model.number="installments"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-800"
            required
          >
            <option
              v-for="option in installmentOptions"
              :key="option.installments"
              :value="option.installments"
            >
              Em {{ option.installments }}X de
              {{ cartStore.formatPrice(option.installment_value / 100) }} (Total:
              {{ cartStore.formatPrice(option.total_amount / 100) }} )
            </option>
          </select>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-4">
          <RouterLink
            to="/cart"
            class="flex-1 px-6 py-3 bg-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-400 transition text-center"
          >
            Voltar ao Carrinho
          </RouterLink>
          <button
            type="submit"
            :disabled="!isFormValid"
            class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition disabled:bg-gray-400 disabled:cursor-not-allowed"
          >
            Confirmar Pedido
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import { storeToRefs } from 'pinia'
import { useRouter } from 'vue-router'
import { useCartStore } from '@/stores/cart'
import { useToast } from 'vue-toast-notification'
import usePurchaseService from '@/composables/usePurchase'

const $toast = useToast()
const router = useRouter()
const cartStore = useCartStore()
const { items, totalPrice, isEmpty, closedPurchase } = storeToRefs(cartStore)
const { calculateInstallments, completePurchase } = usePurchaseService()

const paymentMethod = ref('')
const installments = ref('')
const installmentOptions = ref([])

onMounted(() => {
  if (isEmpty.value) {
    $toast.warning('Seu carrinho está vazio!')
    router.push('/products')
  }
})

const isFormValid = computed(() => {
  if (!paymentMethod.value) return false
  if (!installments.value) return false
  return true
})

watch(paymentMethod, async (newMethod) => {
  if (newMethod) {
    installments.value = ''

    try {
      const installments = await calculateInstallments(totalPrice.value, newMethod)
      installmentOptions.value = installments.options
    } catch (error) {
      console.error('Erro ao calcular parcelas:', error)
      $toast.error('Erro ao calcular parcelas')
    }
  } else {
    installmentOptions.value = []
  }
})

const  handleCheckout = async () => {
  const order = {
    products: items.value,
    payment_method: paymentMethod.value,
    installments: installments.value,
  }

  closedPurchase.value = await completePurchase(order)

  cartStore.clearCart()

  $toast.success('Compra realizada com sucesso!')

  router.push('/purchase-success')
}
</script>
