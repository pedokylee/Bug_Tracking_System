<script setup>
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import Navbar from '@/Components/Navbar.vue'
import Sidebar from '@/Components/Sidebar.vue'

const page = usePage()
const user = computed(() => page.props.auth.user)

const sidebarOpen = ref(false)

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value
}
</script>

<template>
  <div class="app-layout">
    <Sidebar :open="sidebarOpen" @close="sidebarOpen = false" />

    <div class="main-content" :class="{ 'sidebar-open': sidebarOpen }">
      <Navbar :user="user" @toggle-sidebar="toggleSidebar" />

      <main class="page-content">
        <slot />
      </main>
    </div>

    <!-- Mobile overlay -->
    <div
      v-if="sidebarOpen"
      class="sidebar-overlay"
      @click="sidebarOpen = false"
    />
  </div>
</template>