<template>
  <header class="bg-gray-50 shadow-sm border-b border-gray-200 mb-10 fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col items-center md:flex-row md:justify-between gap-4">
        <div class="flex items-center justify-between py-4">
          <h1 class="text-2xl font-bold text-gray-800">
            Carrinho de Compras
            <span class="block text-base font-normal text-gray-600 mt-2">
              Teste Técnico Bússola Social
            </span>
          </h1>
        </div>

        <nav class="flex gap-4">
          <RouterLink
            to="/products"
            class="px-4 py-2 rounded-lg font-medium text-gray-700 transition-colors hover:bg-blue-50 hover:text-blue-600"
            active-class="bg-blue-100 text-blue-700 ring-2 ring-blue-500"
          >
            Produtos
          </RouterLink>
          <RouterLink
            to="/test-connection"
            class="px-4 py-2 rounded-lg font-medium text-gray-700 transition-colors hover:bg-blue-50 hover:text-blue-600"
            active-class="bg-blue-100 text-blue-700 ring-2 ring-blue-500"
          >
            Testar Conexão
          </RouterLink>
          <RouterLink to="/cart">
            <cart-icon-component />
          </RouterLink>
        </nav>
      </div>
    </div>
  </header>
</template>

<script setup>
import CartIconComponent from '@/components/Cart/CartIconComponent.vue'
</script>
