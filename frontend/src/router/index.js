import { createRouter, createWebHistory } from 'vue-router'
import ProductsIndexView from '@/views/Products/ProductsIndexView.vue'
import ProductDetailView from '@/views/Products/ProductDetailView.vue'
import PurchaseStoreView from '@/views/Purchase/PurchaseStoreView.vue'
import CartView from '@/views/Cart/CartView.vue'
import CartCheckoutView from '@/views/Cart/CartCheckoutView.vue'
import TestConnectionVue from '@/views/TestConnection.vue'
import NotFoundView from '@/views/NotFoundView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/products',
    },
    {
      path: '/products',
      name: 'products',
      component: ProductsIndexView,
    },
    {
      path: '/products/:id',
      name: 'product-details',
      component: ProductDetailView,
      props: true,
    },
    {
      path: '/purchase-success',
      name: 'purchase-success',
      component: PurchaseStoreView,
    },
    {
      path: '/cart',
      name: 'cart',
      component: CartView,
    },
    {
      path: '/checkout',
      name: 'checkout',
      component: CartCheckoutView,
    },
    {
      path: '/test-connection',
      name: 'TestAPI',
      component: TestConnectionVue,
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: NotFoundView,
    }

  ],
})

export default router
