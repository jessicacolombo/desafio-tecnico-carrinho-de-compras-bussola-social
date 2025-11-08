<!-- conteudo gerado com IA -->
<template>
  <div class="p-8 min-h-screen">
    <div class="max-w-full mx-auto">
      <h1 class="text-3xl font-bold mb-8 text-white">Teste de Conexão API</h1>

      <button
        @click="testConnection"
        :disabled="testing"
        class="px-8 py-4 bg-blue-600 text-white rounded-lg font-medium text-base transition-colors hover:bg-blue-700 disabled:bg-gray-600 disabled:cursor-not-allowed shadow-lg"
      >
        {{ testing ? 'Testando...' : 'Testar Conexão' }}
      </button>

      <div
        v-if="result"
        class="mt-8 p-6 rounded-lg shadow-xl"
        :class="
          result.success
            ? 'bg-green-900 border-2 border-green-500'
            : 'bg-red-900 border-2 border-red-500'
        "
      >
        <h3 class="mt-0 text-xl font-semibold mb-4 text-white">
          {{ result.success ? '✅ Sucesso!' : '❌ Erro!' }}
        </h3>
        <pre
          class="bg-gray-800 text-gray-100 p-4 rounded overflow-x-auto text-sm border border-gray-700"
          >{{ JSON.stringify(result, null, 2) }}</pre
        >
      </div>

      <div
        v-if="networkInfo"
        class="mt-8 p-6 bg-gray-800 rounded-lg shadow-xl border border-gray-700"
      >
        <h3 class="text-xl font-semibold mb-4 text-white">Informações da Requisição:</h3>
        <ul class="list-none p-0">
          <li class="py-2 border-b border-gray-700 text-gray-200">
            <strong class="text-blue-400">URL Base:</strong> {{ apiUrl }}
          </li>
          <li class="py-2 border-b border-gray-700 text-gray-200">
            <strong class="text-blue-400">Status:</strong> {{ networkInfo.status }}
          </li>
          <li class="py-2 text-gray-200">
            <strong class="text-blue-400">Tempo:</strong> {{ networkInfo.time }}ms
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { fetchProducts } from '@/services/productsService'

const testing = ref(false)
const result = ref(null)
const networkInfo = ref(null)
const apiUrl = import.meta.env.VITE_API_URL || 'http://localhost:3000/api'

const testConnection = async () => {
  testing.value = true
  result.value = null
  networkInfo.value = null

  const startTime = Date.now()

  try {
    const data = await fetchProducts()
    const endTime = Date.now()

    result.value = {
      success: true,
      message: 'Conexão estabelecida com sucesso!',
      data: data,
      itemCount: data.length,
    }

    networkInfo.value = {
      status: 'Conectado',
      time: endTime - startTime,
    }
  } catch (error) {
    const endTime = Date.now()

    result.value = {
      success: false,
      message: 'Falha na conexão',
      error: error.message,
      details: {
        name: error.name,
        stack: error.stack,
      },
    }

    networkInfo.value = {
      status: 'Erro',
      time: endTime - startTime,
    }
  } finally {
    testing.value = false
  }
}
</script>
