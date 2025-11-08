<template>
  <div class="relative inline-block">
    <span
      v-if="!isEmpty"
      class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full min-w-[20px] flex items-center justify-center px-1.5 shadow-lg border-2 border-gray-900 z-10"
    >
      {{ totalItems }}
    </span>
    <img
      src="@/assets/shopping_cart.svg"
      alt="Cart Icon"
      class="w-8 h-8 transition-transform hover:scale-110"
    />
  </div>
</template>

<script setup>
import { storeToRefs } from 'pinia'
import { useCartStore } from '@/stores/cart'

const cartStore = useCartStore()
const { isEmpty, totalItems } = storeToRefs(cartStore)
</script>
