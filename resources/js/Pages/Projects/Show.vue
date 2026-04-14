<script setup>
// Projects/Show.vue
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import StatusBadge from '@/Components/StatusBadge.vue'
 
defineOptions({ layout: AppLayout })
 
defineProps({
  project: Object,
  stats: Object,
})
 
const deleteProject = (project) => {
  if (confirm(`Delete project "${project.name}"? This will remove all its bugs.`)) {
    router.delete(route('projects.destroy', project.id))
  }
}
</script>
 
<template>
  <Head :title="project.name" />
 
  <div class="project-show-page">
    <div class="page-header">
      <div>
        <Link :href="route('projects.index')" class="back-link">← Projects</Link>
        <h1 class="page-title">{{ project.name }}</h1>
        <p class="page-subtitle">{{ project.description }}</p>
      </div>
      <div class="project-actions">
        <Link :href="route('projects.bugs.create', project.id)" class="btn-primary">
          + Report Bug
        </Link>
        <button class="btn-danger" @click="deleteProject(project)">Delete</button>
      </div>
    </div>
 
    <!-- Stats -->
    <div class="project-stats">
      <div class="stat-pill stat-pill--blue">
        <span class="stat-pill__value">{{ stats.total }}</span>
        <span class="stat-pill__label">Total</span>
      </div>
      <div class="stat-pill stat-pill--red">
        <span class="stat-pill__value">{{ stats.open }}</span>
        <span class="stat-pill__label">Open</span>
      </div>
      <div class="stat-pill stat-pill--amber">
        <span class="stat-pill__value">{{ stats.in_progress }}</span>
        <span class="stat-pill__label">In Progress</span>
      </div>
      <div class="stat-pill stat-pill--green">
        <span class="stat-pill__value">{{ stats.resolved }}</span>
        <span class="stat-pill__label">Resolved</span>
      </div>
    </div>
 
    <!-- Bug list -->
    <div class="bug-table-wrapper">
      <div class="bug-table-header">
        <h2>All Bugs</h2>
        <Link :href="route('projects.bugs.index', project.id)" class="see-all">
          View all →
        </Link>
      </div>
 
      <table class="bug-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Assignee</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="bug in project.bugs" :key="bug.id">
            <td class="bug-id-cell">
              <Link :href="route('projects.bugs.show', [project.id, bug.id])" class="bug-id-link">
                #{{ bug.id }}
              </Link>
            </td>
            <td>
              <Link :href="route('projects.bugs.show', [project.id, bug.id])">
                {{ bug.title }}
              </Link>
            </td>
            <td>
              <span :class="['priority-badge', `priority--${bug.priority}`]">
                {{ bug.priority }}
              </span>
            </td>
            <td><StatusBadge :status="bug.status?.name" /></td>
            <td>{{ bug.assignee?.name || '—' }}</td>
          </tr>
        </tbody>
      </table>
 
      <div v-if="!project.bugs?.length" class="empty-state">
        <p>No bugs in this project yet.</p>
      </div>
    </div>
  </div>
</template>