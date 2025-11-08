import { ref } from 'vue'
import { paymentCalculation, purchaseCart } from '@/services/purchaseService'

export default function usePurchase() {
  const loading = ref(false)
  const error = ref(null)
  const installmentOptions = ref([])
  const purchaseResult = ref(null)

  const calculateInstallments = async (amount, paymentMethod) => {
    loading.value = true
    error.value = null
    installmentOptions.value = []

    try {
      const response = await paymentCalculation(amount, paymentMethod)
      installmentOptions.value = response
      return response
    } catch (err) {
      error.value = err.message || 'Erro ao calcular parcelas'
      console.error('Erro ao calcular parcelas:', err)
      throw err
    } finally {
      loading.value = false
    }
  }

  const completePurchase = async (orderData) => {
    loading.value = true
    error.value = null
    purchaseResult.value = null

    try {
      const response = await purchaseCart(orderData)
      purchaseResult.value = response
      return response
    } catch (err) {
      error.value = err.message || 'Erro ao finalizar compra'
      console.error('Erro ao finalizar compra:', err)
      throw err
    } finally {
      loading.value = false
    }
  }

  return {
    loading,
    error,
    installmentOptions,
    purchaseResult,
    calculateInstallments,
    completePurchase,
  }
}