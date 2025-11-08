<template>
  <li class="bg-white rounded-md shadow-md flex flex-col p-5">
    <img src="@/assets/shoppingmode.svg" :alt="product.name" class="w-full h-[200px] p-10" />
    <div class="p-5">
      <div class="h-[120px]">
        <h3 class="text-gray-600 mb-2">{{ product.name }}</h3>
        <p class="text-gray-400 mb-5 text-sm">{{ product.description }}</p>
      </div>
      <span class="text-green-600 font-bold text-2xl block mb-5">
        R$ {{ product.price.formatted }}
      </span>
      <button
        @click="addProductToCart(product)"
        class="bg-blue-500 py-3 w-full rounded-sm hover:bg-blue-600 transition"
      >
        Adicionar ao Carrinho
      </button>
    </div>
  </li>
</template>

<script setup>
import { useCartStore } from '@/stores/cart'
import { useToast } from 'vue-toast-notification'

const props = defineProps({
  product: {
    type: Object,
    required: true,
  },
})

const { addToCart } = useCartStore()
const $toast = useToast()

function addProductToCart(product) {
  addToCart(product)

  $toast.open({
    message: `Produto "${product.name}" adicionado ao carrinho!`,
    type: 'success',
    duration: 3000,
  })
}
</script>
