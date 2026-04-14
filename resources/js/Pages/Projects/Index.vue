<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
 
defineOptions({ layout: AppLayout })
 
defineProps({
  projects: Object, // paginated
})
</script>
 
<template>
  <Head title="Projects" />
 
  <div class="projects-page">
    <div class="page-header">
      <div>
        <h1 class="page-title">Projects</h1>
        <p class="page-subtitle">All bug tracking projects</p>
      </div>
      <Link :href="route('projects.create')" class="btn-primary">+ New Project</Link>
    </div>
 
    <div class="projects-grid">
      <Link
        v-for="project in projects.data"
        :key="project.id"
        :href="route('projects.show', project.id)"
        class="project-card"
      >
        <div class="project-card__icon">{{ project.name[0] }}</div>
        <div class="project-card__body">
          <h3 class="project-card__name">{{ project.name }}</h3>
          <p class="project-card__desc">{{ project.description || 'No description.' }}</p>
          <div class="project-card__footer">
            <span class="bug-count">{{ project.bugs_count }} bugs</span>
            <span class="visibility-badge" :class="project.is_public ? 'public' : 'private'">
              {{ project.is_public ? 'Public' : 'Private' }}
            </span>
          </div>
        </div>
      </Link>
 
      <div v-if="!projects.data?.length" class="empty-state">
        <p>No projects yet.</p>
        <Link :href="route('projects.create')" class="btn-primary">Create your first project</Link>
      </div>
    </div>
  </div>
</template>