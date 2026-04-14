<script setup>
// Bugs/Create.vue
import { Head, useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import FormInput from '@/Components/Form/Input.vue'
import FormSelect from '@/Components/Form/Select.vue'

defineOptions({ layout: AppLayout })

const props = defineProps({
  project: Object,
  statuses: Array,
  users: Array,
  priorities: Array,
})

const form = useForm({
  title: '',
  description: '',
  priority: 'medium',
  assignee_id: '',
  steps_to_reproduce: '',
  expected_behavior: '',
  actual_behavior: '',
  environment: '',
})

const priorityOptions = props.priorities?.map(p => ({
  value: p,
  label: p.charAt(0).toUpperCase() + p.slice(1),
})) || []

const userOptions = props.users?.map(u => ({
  value: u.id,
  label: u.name,
})) || []

const submit = () => {
  form.post(route('projects.bugs.store', props.project.id))
}
</script>

<template>
  <Head title="Report Bug" />

  <div class="form-page">
    <div class="form-page-header">
      <Link :href="route('projects.bugs.index', project.id)" class="back-link">
        ← {{ project.name }}
      </Link>
      <h1 class="page-title">Report a Bug</h1>
    </div>

    <form class="bug-form" @submit.prevent="submit">
      <div class="form-section">
        <h2 class="form-section-title">Bug Details</h2>

        <FormInput
          v-model="form.title"
          label="Title"
          placeholder="Brief, descriptive summary of the bug"
          :error="form.errors.title"
          required
        />

        <div class="form-field">
          <label class="form-label">Description <span class="required-star">*</span></label>
          <textarea
            v-model="form.description"
            class="form-textarea"
            :class="{ 'form-input--error': form.errors.description }"
            placeholder="Detailed description of the bug..."
            rows="4"
          ></textarea>
          <p v-if="form.errors.description" class="form-error">{{ form.errors.description }}</p>
        </div>

        <div class="form-row">
          <FormSelect
            v-model="form.priority"
            label="Priority"
            :options="priorityOptions"
            required
            :error="form.errors.priority"
          />
          <FormSelect
            v-model="form.assignee_id"
            label="Assign To"
            :options="userOptions"
            placeholder="Select developer"
            :error="form.errors.assignee_id"
          />
        </div>
      </div>

      <div class="form-section">
        <h2 class="form-section-title">Reproduction Details</h2>

        <div class="form-field">
          <label class="form-label">Steps to Reproduce</label>
          <textarea
            v-model="form.steps_to_reproduce"
            class="form-textarea"
            placeholder="1. Go to page...&#10;2. Click on...&#10;3. Observe..."
            rows="4"
          ></textarea>
        </div>

        <div class="form-row">
          <div class="form-field">
            <label class="form-label">Expected Behavior</label>
            <textarea
              v-model="form.expected_behavior"
              class="form-textarea"
              placeholder="What should happen..."
              rows="3"
            ></textarea>
          </div>
          <div class="form-field">
            <label class="form-label">Actual Behavior</label>
            <textarea
              v-model="form.actual_behavior"
              class="form-textarea"
              placeholder="What actually happens..."
              rows="3"
            ></textarea>
          </div>
        </div>

        <FormInput
          v-model="form.environment"
          label="Environment"
          placeholder="e.g. Chrome 120 / macOS 14 / Production"
          :error="form.errors.environment"
        />
      </div>

      <div class="form-actions">
        <Link :href="route('projects.bugs.index', project.id)" class="btn-secondary">
          Cancel
        </Link>
        <button type="submit" class="btn-primary" :disabled="form.processing">
          {{ form.processing ? 'Submitting...' : 'Report Bug' }}
        </button>
      </div>
    </form>
  </div>
</template>