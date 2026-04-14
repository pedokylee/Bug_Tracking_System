<script setup>
// Bugs/Show.vue
import { ref } from 'vue'
import { Head, Link, useForm, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import StatusBadge from '@/Components/StatusBadge.vue'

defineOptions({ layout: AppLayout })

const props = defineProps({
  bug: Object,
  project: Object,
})

const commentForm = useForm({ content: '' })

const submitComment = () => {
  commentForm.post(route('comments.store', props.bug.id), {
    onSuccess: () => commentForm.reset(),
  })
}

const deleteBug = () => {
  if (confirm('Are you sure you want to delete this bug?')) {
    router.delete(route('projects.bugs.destroy', [props.project.id, props.bug.id]))
  }
}

const formatDate = (date) => new Date(date).toLocaleDateString('en-US', {
  year: 'numeric', month: 'short', day: 'numeric',
})
</script>

<template>
  <Head :title="bug.title" />

  <div class="bug-show-page">
    <div class="bug-show-header">
      <Link :href="route('projects.bugs.index', project.id)" class="back-link">
        ← {{ project.name }}
      </Link>

      <div class="bug-show-actions">
        <Link :href="route('projects.bugs.edit', [project.id, bug.id])" class="btn-secondary">
          Edit
        </Link>
        <button class="btn-danger" @click="deleteBug">Delete</button>
      </div>
    </div>

    <div class="bug-show-layout">
      <!-- Main content -->
      <div class="bug-show-main">
        <div class="bug-show-card">
          <div class="bug-show-meta">
            <span class="bug-id-large">#{{ bug.id }}</span>
            <StatusBadge :status="bug.status?.name" />
            <span :class="['priority-badge', `priority--${bug.priority}`]">
              {{ bug.priority }}
            </span>
          </div>

          <h1 class="bug-show-title">{{ bug.title }}</h1>

          <div class="bug-show-info">
            <div class="info-row">
              <span class="info-label">Reporter</span>
              <span class="info-value">{{ bug.reporter?.name }}</span>
            </div>
            <div class="info-row">
              <span class="info-label">Reported</span>
              <span class="info-value">{{ formatDate(bug.created_at) }}</span>
            </div>
            <div class="info-row">
              <span class="info-label">Environment</span>
              <span class="info-value">{{ bug.environment || 'Not specified' }}</span>
            </div>
          </div>

          <div class="bug-section">
            <h3 class="bug-section-title">Description</h3>
            <p class="bug-section-content">{{ bug.description }}</p>
          </div>

          <div v-if="bug.steps_to_reproduce" class="bug-section">
            <h3 class="bug-section-title">Steps to Reproduce</h3>
            <pre class="bug-section-pre">{{ bug.steps_to_reproduce }}</pre>
          </div>

          <div v-if="bug.expected_behavior || bug.actual_behavior" class="bug-section bug-behavior-grid">
            <div v-if="bug.expected_behavior">
              <h3 class="bug-section-title">Expected</h3>
              <p class="bug-section-content">{{ bug.expected_behavior }}</p>
            </div>
            <div v-if="bug.actual_behavior">
              <h3 class="bug-section-title">Actual</h3>
              <p class="bug-section-content actual-behavior">{{ bug.actual_behavior }}</p>
            </div>
          </div>
        </div>

        <!-- Comments -->
        <div class="comments-section">
          <h2 class="comments-title">Comments ({{ bug.comments?.length || 0 }})</h2>

          <div class="comment-list">
            <div v-for="comment in bug.comments" :key="comment.id" class="comment-item">
              <div class="comment-avatar">{{ comment.user?.name[0] }}</div>
              <div class="comment-body">
                <div class="comment-header">
                  <strong>{{ comment.user?.name }}</strong>
                  <span class="comment-date">{{ formatDate(comment.created_at) }}</span>
                </div>
                <p class="comment-content">{{ comment.content }}</p>
              </div>
            </div>
            <div v-if="!bug.comments?.length" class="no-comments">No comments yet.</div>
          </div>

          <form class="comment-form" @submit.prevent="submitComment">
            <textarea
              v-model="commentForm.content"
              class="form-textarea"
              placeholder="Add a comment..."
              rows="3"
            ></textarea>
            <button type="submit" class="btn-primary" :disabled="commentForm.processing">
              Post Comment
            </button>
          </form>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="bug-show-sidebar">
        <div class="sidebar-card">
          <h3 class="sidebar-card-title">Assigned To</h3>
          <div v-if="bug.assignee" class="assignee-info">
            <div class="assignee-avatar-lg">
              {{ bug.assignee.name.split(' ').map(n => n[0]).join('') }}
            </div>
            <div>
              <p class="assignee-name">{{ bug.assignee.name }}</p>
              <p class="assignee-email">{{ bug.assignee.email }}</p>
            </div>
          </div>
          <p v-else class="unassigned">Unassigned</p>
        </div>

        <div class="sidebar-card">
          <h3 class="sidebar-card-title">Project</h3>
          <Link :href="route('projects.show', project.id)" class="project-link">
            {{ project.name }}
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>