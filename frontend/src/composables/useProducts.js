import { ref, onMounted, onUnmounted } from 'vue'
import { fetchProducts } from '../services/productsService'

export default function useProducts(initialParams = {}) {
  const items = ref([])
  const loading = ref(false)
  const error = ref(null)
  let abortController

  const load = async (params = initialParams) => {
    loading.value = true
    error.value = null
    abortController = new AbortController()

    try {
      const data = await fetchProducts({
        ...params,
        signal: abortController.signal,
      })
      items.value = data
    } catch (err) {
      if (err.name === 'CanceledError' || err.name === 'AbortError') {
        // requisição cancelada
      } else {
        error.value = err
      }
    } finally {
      loading.value = false
    }
  }

  onMounted(() => load())
  onUnmounted(() => {
    if (abortController) {
      abortController.abort()
    }
  })

  return {
    items,
    loading,
    error,
    load,
  }
}
