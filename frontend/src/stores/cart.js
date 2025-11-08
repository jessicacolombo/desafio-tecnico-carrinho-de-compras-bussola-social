import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useCartStore = defineStore('cart', () => {
  const items = ref([])
  const closedPurchase = ref([])

  const totalItems = computed(() => {
    return items.value.reduce((total, item) => total + item.quantity, 0)
  })

  const totalPrice = computed(() => {
    return items.value.reduce((total, item) => total + item.price.value * item.quantity, 0)
  })

  const isEmpty = computed(() => items.value.length === 0)

  function addToCart(product) {
    const existingItem = items.value.find((item) => item.id === product.id)

    if (existingItem) {
      existingItem.quantity++
    } else {
      items.value.push({
        ...product,
        quantity: 1,
      })
    }
  }

  function removeFromCart(productId) {
    const index = items.value.findIndex((item) => item.id === productId)
    if (index > -1) {
      items.value.splice(index, 1)
    }
  }

  function incrementQuantity(productId) {
    const item = items.value.find((item) => item.id === productId)
    if (item) {
      item.quantity++
    }
  }

  function decrementQuantity(productId) {
    const item = items.value.find((item) => item.id === productId)
    if (item) {
      if (item.quantity > 1) {
        item.quantity--
      } else {
        removeFromCart(productId)
      }
    }
  }

  function formatPrice(value) {
    return new Intl.NumberFormat('pt-BR', {
      style: 'currency',
      currency: 'BRL',
    }).format(value)
  }

  function clearCart() {
    items.value = []
  }

  function getItemQuantity(productId) {
    const item = items.value.find((item) => item.id === productId)
    return item ? item.quantity : 0
  }

  return {
    items,
    closedPurchase,
    totalItems,
    totalPrice,
    formatPrice,
    isEmpty,
    addToCart,
    removeFromCart,
    incrementQuantity,
    decrementQuantity,
    clearCart,
    getItemQuantity,
  }
})
