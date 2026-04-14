<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import FormInput from '@/Components/Form/Input.vue'
 
defineOptions({ layout: AppLayout })
 
const form = useForm({
  name: '',
  description: '',
  is_public: false,
})
 
const submit = () => {
  form.post(route('projects.store'))
}
</script>
 
<template>
  <Head title="New Project" />
 
  <div class="form-page">
    <div class="form-page-header">
      <Link :href="route('projects.index')" class="back-link">← Projects</Link>
      <h1 class="page-title">New Project</h1>
    </div>
 
    <form class="bug-form" @submit.prevent="submit">
      <div class="form-section">
        <FormInput
          v-model="form.name"
          label="Project Name"
          placeholder="e.g. E-Commerce Platform"
          :error="form.errors.name"
          required
        />
 
        <div class="form-field">
          <label class="form-label">Description</label>
          <textarea
            v-model="form.description"
            class="form-textarea"
            placeholder="Brief description of this project..."
            rows="3"
          ></textarea>
          <p v-if="form.errors.description" class="form-error">{{ form.errors.description }}</p>
        </div>
 
        <div class="form-field form-checkbox">
          <input
            type="checkbox"
            id="is_public"
            v-model="form.is_public"
            class="checkbox-input"
          />
          <label for="is_public" class="checkbox-label">
            Make this project public
            <span class="form-hint">Public projects are visible to all users.</span>
          </label>
        </div>
      </div>
 
      <div class="form-actions">
        <Link :href="route('projects.index')" class="btn-secondary">Cancel</Link>
        <button type="submit" class="btn-primary" :disabled="form.processing">
          {{ form.processing ? 'Creating...' : 'Create Project' }}
        </button>
      </div>
    </form>
  </div>
</template>