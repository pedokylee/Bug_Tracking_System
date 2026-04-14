<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  user: Object,
})

const emit = defineEmits(['toggle-sidebar'])

const userMenuOpen = ref(false)

const logout = () => {
  router.post(route('logout'))
}
</script>

<template>
  <nav class="navbar">
    <div class="navbar-left">
      <button class="sidebar-toggle" @click="emit('toggle-sidebar')" aria-label="Toggle sidebar">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <Link :href="route('dashboard')" class="brand">
        <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-white font-bold">BugHive</span>
      </Link>
    </div>

    <div class="navbar-right">
      <!-- Quick actions -->
      <Link :href="route('projects.index')" class="btn-report">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Report Bug
      </Link>

      <!-- User menu -->
      <div class="user-menu-wrapper" v-if="user">
        <button class="user-avatar-btn" @click="userMenuOpen = !userMenuOpen">
          <div class="avatar">{{ user.name.charAt(0).toUpperCase() }}</div>
          <span class="user-name hidden sm:inline">{{ user.name }}</span>
          <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
          </svg>
        </button>

        <div v-if="userMenuOpen" class="user-dropdown">
          <div class="dropdown-header">
            <p class="dropdown-name">{{ user.name }}</p>
            <p class="dropdown-email">{{ user.email }}</p>
          </div>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item danger" @click="logout">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Sign Out
          </button>
        </div>
      </div>
    </div>
  </nav>
</template>