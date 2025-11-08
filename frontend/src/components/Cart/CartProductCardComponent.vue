<template>
  <li class="bg-white rounded-md shadow-md flex p-5 justify-between items-center">
    <div class="flex items-start justify-between w-full">
      <div>
        <img src="@/assets/shoppingmode.svg" :alt="item.name" class="w-20 h-20 mr-5" />
        <div>
          <h3 class="text-gray-600 mb-2">{{ item.name }}</h3>
          <p class="text-gray-400 mb-2 text-sm">Quantidade:</p>
          <div class="mb-5 mt-3 flex items-center">
            <button
              @click="decrementQuantity(item.id)"
              class="h-[35px] w-[35px] rounded-full bg-gray-300 hover:bg-gray-400"
            >
              -
            </button>
            <span class="text-gray-400 text-sm border py-2 px-3 min-w-[50px] text-center mx-2">{{
              item.quantity
            }}</span>
            <button
              @click="incrementQuantity(item.id)"
              class="h-[35px] w-[35px] rounded-full bg-gray-300 hover:bg-gray-400"
            >
              +
            </button>
          </div>
          <span class="text-green-600 font-bold text-lg">
            {{ item.price.formatted }}
          </span>
        </div>
      </div>
      <button
        @click="removeFromCart(item.id)"
        class="ml-5 bg-red-500 text-white py-2 px-4 rounded-sm hover:bg-red-600 transition"
      >
        Remover
      </button>
    </div>
  </li>
</template>
<script setup>
import { useCartStore } from '@/stores/cart'

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
})

const { removeFromCart, incrementQuantity, decrementQuantity } = useCartStore()
</script>
