import apiClient from './apiClient'

export async function paymentCalculation(amount, paymentMethod) {
  const response = await apiClient.get(
    `/payment-calculation?amount=${amount}&payment_method=${paymentMethod}`,
  )
  return response.data
}

export async function purchaseCart(cartData) {
  const response = await apiClient.post('/purchase', cartData)
  return response.data
}
