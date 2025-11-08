<script setup>
import HeaderComponent from '@/components/Header/HeaderComponent.vue'
import FooterComponent from '@/components/Footer/FooterComponent.vue'
</script>

<template>
  <div id="app">
    <header-component />

    <main class="max-w-7xl mx-auto min-h-screen ">
      <router-view />
    </main>

    <footer-component />
  </div>
</template>

<style scoped></style>
