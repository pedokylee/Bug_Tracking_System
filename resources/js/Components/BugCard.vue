<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import StatusBadge from '@/Components/StatusBadge.vue'
 
const props = defineProps({
  bug: Object,
})
 
const priorityConfig = {
  critical: { label: 'Critical', class: 'priority--critical' },
  high:     { label: 'High',     class: 'priority--high' },
  medium:   { label: 'Medium',   class: 'priority--medium' },
  low:      { label: 'Low',      class: 'priority--low' },
}
 
const priority = computed(() => priorityConfig[props.bug.priority] || priorityConfig.low)
const initials = computed(() =>
  props.bug.assignee?.name
    ?.split(' ')
    .map(n => n[0])
    .join('')
    .toUpperCase()
    .slice(0, 2) || '?'
)
</script>
 
<template>
  <Link
    :href="route('projects.bugs.show', [bug.project_id, bug.id])"
    class="bug-card"
  >
    <div class="bug-card__header">
      <span :class="['priority-badge', priority.class]">{{ priority.label }}</span>
      <StatusBadge :status="bug.status?.name" size="sm" />
    </div>
 
    <h3 class="bug-card__title">{{ bug.title }}</h3>
    <p class="bug-card__desc">{{ bug.description?.slice(0, 100) }}...</p>
 
    <div class="bug-card__footer">
      <span class="bug-id">#{{ bug.id }}</span>
      <div class="assignee-chip" v-if="bug.assignee">
        <div class="assignee-avatar">{{ initials }}</div>
        <span>{{ bug.assignee.name }}</span>
      </div>
    </div>
  </Link>
</template>