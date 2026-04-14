<script setup>
import { ref, onMounted, computed } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import BugCard from '@/Components/BugCard.vue'
import StatusBadge from '@/Components/StatusBadge.vue'
import { publicApi, bugApi } from '@/Services/api'

defineOptions({ layout: AppLayout })

const props = defineProps({
  recentBugs: Array,
  myBugs: Array,
  user: Object,
})

// Fetched via Axios from public API
const stats = ref(null)
const statsLoading = ref(true)
const priorityData = ref([])

onMounted(async () => {
  try {
    const [statsRes, priorityRes] = await Promise.all([
      publicApi.getStats(),
      bugApi.getByPriority(),
    ])
    stats.value = statsRes.data
    priorityData.value = priorityRes.data
  } catch (e) {
    console.error('Failed to load dashboard stats', e)
  } finally {
    statsLoading.value = false
  }
})

const statCards = computed(() => stats.value ? [
  { label: 'Total Bugs',    value: stats.value.total_bugs,     color: 'blue' },
  { label: 'Open',          value: stats.value.open_bugs,      color: 'red' },
  { label: 'In Progress',   value: stats.value.in_progress,    color: 'amber' },
  { label: 'Resolved Today',value: stats.value.resolved_today, color: 'green' },
  { label: 'Critical',      value: stats.value.critical_bugs,  color: 'red' },
  { label: 'Projects',      value: stats.value.total_projects, color: 'purple' },
] : [])
</script>

<template>
  <Head title="Dashboard" />

  <div class="dashboard-page">
    <div class="page-header">
      <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, {{ user?.name }}. Here's your overview.</p>
      </div>
      <Link :href="route('projects.index')" class="btn-primary">View Projects</Link>
    </div>

    <!-- Stats Grid — loaded via Axios -->
    <div v-if="statsLoading" class="stats-loading">
      <div v-for="i in 6" :key="i" class="stat-skeleton"></div>
    </div>
    <div v-else class="stats-grid">
      <div
        v-for="card in statCards"
        :key="card.label"
        class="stat-card"
        :class="`stat-card--${card.color}`"
      >
        <p class="stat-label">{{ card.label }}</p>
        <p class="stat-value">{{ card.value }}</p>
      </div>
    </div>

    <!-- Recent Bugs -->
    <section class="dashboard-section">
      <div class="section-header">
        <h2 class="section-title">Recent Bugs</h2>
        <Link :href="route('projects.index')" class="see-all">See all →</Link>
      </div>
      <div class="bug-grid">
        <BugCard v-for="bug in recentBugs" :key="bug.id" :bug="bug" />
        <div v-if="!recentBugs?.length" class="empty-state">
          No bugs reported yet.
        </div>
      </div>
    </section>

    <!-- My Assigned Bugs -->
    <section class="dashboard-section">
      <div class="section-header">
        <h2 class="section-title">Assigned to Me</h2>
      </div>
      <div class="bug-list">
        <div v-for="bug in myBugs" :key="bug.id" class="bug-list-item">
          <StatusBadge :status="bug.status?.name" />
          <Link
            :href="route('projects.bugs.show', [bug.project_id, bug.id])"
            class="bug-list-title"
          >
            {{ bug.title }}
          </Link>
          <span class="bug-list-project">{{ bug.project?.name }}</span>
        </div>
        <div v-if="!myBugs?.length" class="empty-state">
          No bugs assigned to you.
        </div>
      </div>
    </section>
  </div>
</template>