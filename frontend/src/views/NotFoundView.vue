<template>
  <div class="flex flex-col items-center justify-center min-h-[70vh] px-4 text-center">
    <h1 class="text-9xl font-bold text-gray-600 mb-4">404</h1>
    <h2 class="text-2xl font-semibold text-white mb-4">Página não encontrada</h2>
    <p class="text-gray-400 mb-8">A página que você procura não existe.</p>

    <RouterLink
      to="/products"
      class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors"
    >
      Voltar para produtos
    </RouterLink>
  </div>
</template>