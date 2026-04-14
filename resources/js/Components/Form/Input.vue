<script setup>
defineProps({
  modelValue: String,
  label: String,
  type: { type: String, default: 'text' },
  placeholder: String,
  error: String,
  required: Boolean,
  hint: String,
})
defineEmits(['update:modelValue'])
</script>
 
<template>
  <div class="form-field">
    <label v-if="label" class="form-label">
      {{ label }}
      <span v-if="required" class="required-star">*</span>
    </label>
 
    <input
      :type="type"
      :value="modelValue"
      :placeholder="placeholder"
      :required="required"
      class="form-input"
      :class="{ 'form-input--error': error }"
      @input="$emit('update:modelValue', $event.target.value)"
    />
 
    <p v-if="hint && !error" class="form-hint">{{ hint }}</p>
    <p v-if="error" class="form-error">{{ error }}</p>
  </div>
</template>