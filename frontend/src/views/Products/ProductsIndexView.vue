<template>
  <div class="products-view">
    <div class="w-max-7xl px-10">
      <h1 class="text-gray-100 font-semibold mb-5">Produtos</h1>

      <div v-if="loading" class="text-center py-20 px-10">
        <p>Carregando produtos...</p>
      </div>

      <ul v-else-if="items.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <product-card v-for="product in items" :key="product.id" :product="product" />
      </ul>

      <div v-else class="text-center py-20 px-10">
        <p>Nenhum produto encontrado.</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import useProducts from '@/composables/useProducts'
import ProductCard from '@/components/Product/ProductCardComponent.vue'

const { items, loading } = useProducts()
</script>