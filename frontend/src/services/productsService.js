import apiClient from './apiClient'

export function fetchProducts(params = {}) {
  return apiClient
    .get('/products', {
      params,
    })
    .then((r) => r.data)
}

export function fetchProductById(id) {
  return apiClient.get(`/products/${id}`).then((r) => r.data)
}
