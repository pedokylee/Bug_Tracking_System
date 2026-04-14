<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import FormInput from '@/Components/Form/Input.vue'
import FormSelect from '@/Components/Form/Select.vue'

defineOptions({ layout: AppLayout })

const props = defineProps({
  bug: Object,
  project: Object,
  statuses: Array,
  users: Array,
  priorities: Array,
})

const form = useForm({
  title: props.bug.title,
  description: props.bug.description,
  priority: props.bug.priority,
  status_id: props.bug.status_id,
  assignee_id: props.bug.assignee_id || '',
  steps_to_reproduce: props.bug.steps_to_reproduce || '',
  expected_behavior: props.bug.expected_behavior || '',
  actual_behavior: props.bug.actual_behavior || '',
  environment: props.bug.environment || '',
})

const statusOptions = props.statuses?.map(s => ({ value: s.id, label: s.name })) || []
const priorityOptions = props.priorities?.map(p => ({
  value: p, label: p.charAt(0).toUpperCase() + p.slice(1),
})) || []
const userOptions = props.users?.map(u => ({ value: u.id, label: u.name })) || []

const submit = () => {
  form.patch(route('projects.bugs.update', [props.project.id, props.bug.id]))
}
</script>

<template>
  <Head :title="`Edit #${bug.id}`" />

  <div class="form-page">
    <div class="form-page-header">
      <Link :href="route('projects.bugs.show', [project.id, bug.id])" class="back-link">
        ← Bug #{{ bug.id }}
      </Link>
      <h1 class="page-title">Edit Bug</h1>
    </div>

    <form class="bug-form" @submit.prevent="submit">
      <div class="form-section">
        <h2 class="form-section-title">Bug Details</h2>

        <FormInput v-model="form.title" label="Title" :error="form.errors.title" required />

        <div class="form-field">
          <label class="form-label">Description</label>
          <textarea v-model="form.description" class="form-textarea" rows="4"></textarea>
          <p v-if="form.errors.description" class="form-error">{{ form.errors.description }}</p>
        </div>

        <div class="form-row">
          <FormSelect v-model="form.priority" label="Priority" :options="priorityOptions" :error="form.errors.priority" />
          <FormSelect v-model="form.status_id" label="Status" :options="statusOptions" :error="form.errors.status_id" />
          <FormSelect v-model="form.assignee_id" label="Assignee" :options="userOptions" placeholder="Unassigned" />
        </div>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Reproduction Details</h2>

        <div class="form-field">
          <label class="form-label">Steps to Reproduce</label>
          <textarea v-model="form.steps_to_reproduce" class="form-textarea" rows="4"></textarea>
        </div>

        <div class="form-row">
          <div class="form-field">
            <label class="form-label">Expected Behavior</label>
            <textarea v-model="form.expected_behavior" class="form-textarea" rows="3"></textarea>
          </div>
          <div class="form-field">
            <label class="form-label">Actual Behavior</label>
            <textarea v-model="form.actual_behavior" class="form-textarea" rows="3"></textarea>
          </div>
        </div>

        <FormInput v-model="form.environment" label="Environment" />
      </div>

      <div class="form-actions">
        <Link :href="route('projects.bugs.show', [project.id, bug.id])" class="btn-secondary">Cancel</Link>
        <button type="submit" class="btn-primary" :disabled="form.processing">
          {{ form.processing ? 'Saving...' : 'Save Changes' }}
        </button>
      </div>
    </form>
  </div>
</template>