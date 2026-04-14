<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

defineProps({
  open: Boolean,
})

defineEmits(['close'])

const page = usePage()

const navItems = [
  { label: 'Dashboard',  route: 'dashboard',       icon: 'dashboard' },
  { label: 'Projects',   route: 'projects.index',  icon: 'projects' },
  { label: 'My Bugs',    route: 'dashboard',       icon: 'bugs' },
]

const isActive = (routeName) => {
  return page.url.startsWith('/' + routeName.replace('.', '/').split('.')[0])
}

const getSvgIcon = (icon) => {
  const icons = {
    dashboard: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>',
    projects: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
    bugs: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
  }
  return icons[icon] || ''
}
</script>

<template>
  <aside class="sidebar" :class="{ open }">
    <div class="sidebar-header">
      <Link :href="route('dashboard')" class="sidebar-brand">
        <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
          <p class="brand-title">BugHive</p>
          <p class="brand-subtitle">Bug Tracker</p>
        </div>
      </Link>
      <button class="sidebar-close" @click="$emit('close')">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <nav class="sidebar-nav">
      <p class="nav-section-label">Navigation</p>

      <Link
        v-for="item in navItems"
        :key="item.route"
        :href="route(item.route)"
        class="nav-item"
        :class="{ active: isActive(item.route) }"
      >
        <span class="nav-icon" v-html="getSvgIcon(item.icon)"></span>
        <span class="nav-label">{{ item.label }}</span>
      </Link>
    </nav>

    <div class="sidebar-footer">
      <p class="version-tag">BugHive v1.0</p>
    </div>
  </aside>
</template>