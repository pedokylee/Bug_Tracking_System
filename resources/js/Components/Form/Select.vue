<script setup>
defineProps({
  modelValue: [String, Number],
  label: String,
  options: Array, // [{ value, label }]
  placeholder: String,
  error: String,
  required: Boolean,
})
defineEmits(['update:modelValue'])
</script>
 
<template>
  <div class="form-field">
    <label v-if="label" class="form-label">
      {{ label }}
      <span v-if="required" class="required-star">*</span>
    </label>
 
    <select
      :value="modelValue"
      :required="required"
      class="form-select"
      :class="{ 'form-select--error': error }"
      @change="$emit('update:modelValue', $event.target.value)"
    >
      <option value="" disabled>{{ placeholder || 'Select an option' }}</option>
      <option
        v-for="opt in options"
        :key="opt.value"
        :value="opt.value"
      >
        {{ opt.label }}
      </option>
    </select>
 
    <p v-if="error" class="form-error">{{ error }}</p>
  </div>
</template>