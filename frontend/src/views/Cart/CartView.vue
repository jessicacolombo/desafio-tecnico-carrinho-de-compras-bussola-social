<template>
  <div class="cart-view">
    <h1 class="text-gray-100 font-semibold mb-5">Carrinho de Compras</h1>
    <div class="w-max-7xl px-10 bg-white h-full rounded-sm shadow-md p-5">
      <div v-if="items.length === 0" class="text-center py-20 px-10 text-gray-400">
        <p>Seu carrinho está vazio.</p>
      </div>

      <div v-else class="flex flex-col py-7">
        <ul class="space-y-4 mb-5">
          <cart-product-card-component v-for="item in items" :key="item.id" :item="item" />
        </ul>
        <p class="text-3xl text-gray-800">
          {{ cartStore.formatPrice(totalPrice / 100) }}
        </p>
        <span class="text-gray-400 mb-5 text-sm">Em até 12 vezes</span>
        <button
          class="bg-gray-300 text-gray-700 py-2 px-4 rounded-sm mb-5 hover:bg-gray-400 transition"
          @click="clearCart"
        >
          Esvaziar Carrinho
        </button>
        <RouterLink
          class="bg-green-500 text-gray-700 py-2 px-4 rounded-sm mb-5 hover:bg-green-400 transition text-center"
          to="/checkout"
        >
          Finalizar Compra
        </RouterLink>
      </div>
    </div>
  </div>
</template>
<script setup>
import { storeToRefs } from 'pinia'
import { useCartStore } from '@/stores/cart'
import CartProductCardComponent from '@/components/Cart/CartProductCardComponent.vue'
import { useToast } from 'vue-toast-notification'
import { RouterLink } from 'vue-router'

const $toast = useToast()
const cartStore = useCartStore()
const { items, totalPrice } = storeToRefs(cartStore)

function clearCart() {
  cartStore.clearCart()

  $toast.open({
    message: 'Carrinho esvaziado com sucesso!',
    type: 'success',
    duration: 3000,
  })
}
</script>
