<script setup>
import { ref, watch } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import BugCard from '@/Components/BugCard.vue'
import StatusBadge from '@/Components/StatusBadge.vue'

defineOptions({ layout: AppLayout })

const props = defineProps({
  project: Object,
  bugs: Object, // paginated
  statuses: Array,
  filters: Object,
})

const search = ref(props.filters?.search || '')
const statusFilter = ref(props.filters?.status || '')
const priorityFilter = ref(props.filters?.priority || '')

// Debounced filter — passes props down via Inertia (Laravel to Vue)
let debounceTimer = null
const applyFilters = () => {
  clearTimeout(debounceTimer)
  debounceTimer = setTimeout(() => {
    router.get(
      route('projects.bugs.index', props.project.id),
      {
        search: search.value || undefined,
        status: statusFilter.value || undefined,
        priority: priorityFilter.value || undefined,
      },
      { preserveState: true, replace: true }
    )
  }, 300)
}

watch([search, statusFilter, priorityFilter], applyFilters)

const priorities = ['low', 'medium', 'high', 'critical']
</script>

<template>
  <Head :title="`${project.name} — Bugs`" />

  <div class="bugs-page">
    <div class="page-header">
      <div>
        <Link :href="route('projects.index')" class="back-link">← Projects</Link>
        <h1 class="page-title">{{ project.name }}</h1>
        <p class="page-subtitle">{{ bugs.total }} bugs total</p>
      </div>
      <Link :href="route('projects.bugs.create', project.id)" class="btn-primary">
        + Report Bug
      </Link>
    </div>

    <!-- Filters -->
    <div class="filter-bar">
      <input
        v-model="search"
        type="search"
        class="filter-search"
        placeholder="Search bugs..."
      />

      <select v-model="statusFilter" class="filter-select">
        <option value="">All Statuses</option>
        <option v-for="s in statuses" :key="s.id" :value="s.name">{{ s.name }}</option>
      </select>

      <select v-model="priorityFilter" class="filter-select">
        <option value="">All Priorities</option>
        <option v-for="p in priorities" :key="p" :value="p">
          {{ p.charAt(0).toUpperCase() + p.slice(1) }}
        </option>
      </select>
    </div>

    <!-- Bug Grid -->
    <div class="bug-grid">
      <BugCard v-for="bug in bugs.data" :key="bug.id" :bug="bug" />
      <div v-if="!bugs.data?.length" class="empty-state">
        <p>No bugs match your filters.</p>
        <Link :href="route('projects.bugs.create', project.id)" class="btn-primary">
          Report the first bug
        </Link>
      </div>
    </div>

    <!-- Pagination -->
    <div v-if="bugs.last_page > 1" class="pagination">
      <Link
        v-for="link in bugs.links"
        :key="link.label"
        :href="link.url"
        class="page-link"
        :class="{ active: link.active, disabled: !link.url }"
        v-html="link.label"
      />
    </div>
  </div>
</template>