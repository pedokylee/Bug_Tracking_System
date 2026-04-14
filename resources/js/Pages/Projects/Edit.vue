<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  project: Object,
})

defineOptions({ layout: AppLayout })

const form = useForm({
  is_public: props.project.is_public,
})

const submit = () => {
  form.put(route('projects.update', props.project.id))
}
</script>

<template>
  <Head title="Edit Project" />

  <div class="form-page">
    <div class="form-page-header">
      <Link :href="route('projects.show', project.id)" class="back-link">← {{ project.name }}</Link>
      <h1 class="page-title">Edit Project Visibility</h1>
    </div>

    <form class="bug-form" @submit.prevent="submit">
      <div class="form-section">
        <div class="project-info">
          <h3>{{ project.name }}</h3>
          <p>{{ project.description }}</p>
        </div>

        <div class="form-field">
          <label class="form-label">Visibility</label>
          <div class="visibility-options">
            <label class="visibility-option">
              <input
                type="radio"
                :value="false"
                v-model="form.is_public"
                class="radio-input"
              />
              <span class="radio-label">
                <strong>Private</strong>
                <span class="option-hint">Only project members can access</span>
              </span>
            </label>
            <label class="visibility-option">
              <input
                type="radio"
                :value="true"
                v-model="form.is_public"
                class="radio-input"
              />
              <span class="radio-label">
                <strong>Public</strong>
                <span class="option-hint">Visible to all users</span>
              </span>
            </label>
          </div>
          <p v-if="form.errors.is_public" class="form-error">{{ form.errors.is_public }}</p>
        </div>
      </div>

      <div class="form-actions">
        <Link :href="route('projects.show', project.id)" class="btn-secondary">Cancel</Link>
        <button type="submit" class="btn-primary" :disabled="form.processing">
          {{ form.processing ? 'Saving...' : 'Save Changes' }}
        </button>
      </div>
    </form>
  </div>
</template>

<style scoped>
.project-info {
  background-color: rgba(255, 255, 255, 0.05);
  padding: 1.5rem;
  border-radius: 0.5rem;
  margin-bottom: 2rem;
}

.project-info h3 {
  margin: 0 0 0.5rem 0;
  font-size: 1.5rem;
}

.project-info p {
  margin: 0;
  color: #9ca3af;
}

.visibility-options {
  display: flex;
  gap: 1.5rem;
  margin-top: 0.75rem;
}

.visibility-option {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  cursor: pointer;
  padding: 0.75rem;
  border: 2px solid transparent;
  border-radius: 0.5rem;
  transition: all 0.2s ease;
}

.visibility-option:hover {
  background-color: rgba(255, 255, 255, 0.05);
}

.radio-input {
  margin-top: 0.25rem;
  cursor: pointer;
}

.radio-label {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.radio-label strong {
  font-weight: 600;
  color: inherit;
}

.option-hint {
  font-size: 0.875rem;
  color: #9ca3af;
}
</style>
