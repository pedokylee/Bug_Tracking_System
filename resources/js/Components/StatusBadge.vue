<script setup>
import { computed } from 'vue'

const props = defineProps({
  status: String,
  size: { type: String, default: 'md' }
})
 
const statusClass = computed(() => {
  const statusName = props.status?.toLowerCase().replace(/\s+/g, '-').replace(/'/g, '')
  return `status-badge--${statusName || 'closed'}`
})
</script>
 
<template>
  <span
    class="status-badge"
    :class="statusClass"
  >
    <span class="status-dot"></span>
    {{ status }}
  </span>
</template>