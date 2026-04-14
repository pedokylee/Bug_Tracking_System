# CSS Audit: Quick Reference & Fix Guide

## 🔴 CRITICAL FIXES REQUIRED

### 1. TextInput.vue - DELETE
**Status:** Legacy component - Remove entirely  
**Replacement:** Use `Form/Input.vue` instead  

### 2. PrimaryButton.vue - SIMPLIFY
**Current:** 
```vue
<button class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900">
```

**Fixed:**
```vue
<button class="btn-primary">
  <slot />
</button>
```

Note: Current button is actually GRAY, not primary. If you need a primary button, use `btn-primary` from app.css (orange).

---

### 3. SecondaryButton.vue - REBUILD
**Current:** Uses light theme (white background, gray text)  
**Issue:** Design system uses dark theme with gray buttons

**Fixed:**
```vue
<button class="btn-secondary">
  <slot />
</button>
```

Or update inline to dark theme:
```vue
<button class="inline-flex items-center px-4 py-2 bg-gray-700 text-white rounded-lg font-semibold hover:bg-gray-600 transition-colors">
  <slot />
</button>
```

---

### 4. NavLink.vue - UPDATE COLORS
**Current:**
```vue
props.active
  ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 ...'
  : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 ...'
```

**Fixed:**
```vue
props.active
  ? 'inline-flex items-center px-1 pt-1 border-b-2 border-orange-500 text-sm font-medium text-white ...'
  : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-300 hover:text-white ...'
```

---

### 5. ResponsiveNavLink.vue - REBUILD
**Current:** Light theme + indigo colors (COMPLETELY WRONG FOR DARK APP)

**Fixed:** Should use dark theme classes
```vue
props.active
  ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-orange-500 text-white bg-gray-800/50 font-medium'
  : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-300 hover:text-white hover:bg-gray-800/50 font-medium'
```

---

### 6. DropdownLink.vue - USE EXISTING CLASS
**Current:**
```vue
class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
```

**Fixed:** Use app.css class
```vue
class="dropdown-item"
```

The `.dropdown-item` class is already defined in app.css with proper dark theme styling:
```css
.dropdown-item {
  @apply w-full flex items-center gap-2 px-4 py-2 text-left text-gray-300 hover:text-white hover:bg-gray-800 transition-colors;
}

.dropdown-item.danger {
  @apply text-red-400 hover:text-red-300 hover:bg-red-500/10;
}
```

---

### 7. Dropdown.vue - UPDATE CONTENT CLASSES
**Current:**
```vue
contentClasses: {
  type: String,
  default: 'py-1 bg-white',
},
```

**Fixed:**
```vue
contentClasses: {
  type: String,
  default: 'py-1 bg-gray-900 border border-gray-700 rounded-lg',
},
```

And update backdrop to use dark theme:
```vue
class="absolute z-50 mt-2 rounded-lg shadow-lg"
// Remove default 'bg-white' content class
```

---

### 8. DangerButton.vue - SIMPLIFY
**Current:**
```vue
class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700"
```

**Fixed:**
```vue
class="btn-danger"
```

This is already defined in app.css:
```css
.btn-danger {
  @apply px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold transition-colors;
}
```

---

### 9. Checkbox.vue - UPDATE ACCENT COLOR
**Current:**
```vue
class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
```

**Fixed:**
```vue
class="w-5 h-5 rounded bg-gray-700 border border-gray-600 cursor-pointer accent-orange-500"
```

Or add to app.css:
```css
input[type="checkbox"] {
  @apply bg-gray-700 border-gray-600 text-orange-500 cursor-pointer;
}
```

---

## 🟠 WARNING FIXES

### StatusBadge.vue - REMOVE INLINE STYLES

**Current Problem:**
```js
const colorMap = {
  'Open':        { bg: '#EFF6FF', text: '#1D4ED8', dot: '#3B82F6' },
  'In Progress': { bg: '#FFFBEB', text: '#92400E', dot: '#F59E0B' },
  // ... hardcoded HEX values
}
```

**Add these CSS classes to app.css:**
```css
.status-badge--open {
  @apply bg-blue-500/20 text-blue-300 border border-blue-500/30;
}

.status-badge--in-progress {
  @apply bg-amber-500/20 text-amber-300 border border-amber-500/30;
}

.status-badge--in-review {
  @apply bg-purple-500/20 text-purple-300 border border-purple-500/30;
}

.status-badge--resolved {
  @apply bg-green-500/20 text-green-300 border border-green-500/30;
}

.status-badge--closed {
  @apply bg-gray-500/20 text-gray-300 border border-gray-500/30;
}

.status-badge--wont-fix {
  @apply bg-red-500/20 text-red-300 border border-red-500/30;
}
```

**Then update component to use classes instead of styles:**
```vue
<template>
  <span
    class="status-badge"
    :class="[`status-badge--${statusClass}`, `status-badge--${size}`]"
  >
    <span class="status-dot"></span>
    {{ status }}
  </span>
</template>

<script setup>
const props = defineProps({
  status: String,
  size: { type: String, default: 'md' }
})

const statusClass = computed(() => {
  const map = {
    'Open': 'open',
    'In Progress': 'in-progress',
    'In Review': 'in-review',
    'Resolved': 'resolved',
    'Closed': 'closed',
    "Won't Fix": 'wont-fix',
  }
  return map[props.status] || 'closed'
})
</script>
```

---

### InputLabel.vue - FIX COLORS
**Current:**
```vue
<label class="block text-sm font-medium text-gray-700">
```

**Fixed:**
```vue
<label class="form-label">
```

Or update to match dark theme:
```vue
<label class="block text-sm font-medium text-gray-300">
```

---

### Modal.vue - UPDATE BACKDROP
**Current:**
```vue
<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
```

**Fixed:**
```vue
<div class="absolute inset-0 bg-black/50"></div>
```

Or add to app.css and use class:
```css
.modal-backdrop {
  @apply fixed inset-0 bg-black/50 z-50;
}
```

---

### Navbar.vue - FIX CLASS REFERENCE
**Current:**
```vue
<span class="brand-name">BugHive</span>
```

**Issue:** `brand-name` class is undefined  
**Fixed:** Either remove the span or add class to app.css:
```vue
<!-- Option 1: Remove span -->
<span>BugHive</span>

<!-- Option 2: Add class to app.css -->
.brand-name {
  @apply text-lg font-bold text-white;
}
```

---

## 📋 CSS CLASSES CHECKLIST

### ✅ All Defined & Used Correctly:
- [x] `.form-input` — Form inputs
- [x] `.form-textarea` — Text areas
- [x] `.form-select` — Select dropdowns
- [x] `.form-label` — Form labels
- [x] `.form-error` — Error messages
- [x] `.btn-primary` — Primary button (orange)
- [x] `.btn-secondary` — Secondary button (gray)
- [x] `.btn-danger` — Danger button (red)
- [x] `.nav-item` — Sidebar nav items
- [x] `.sidebar-*` — All sidebar classes
- [x] `.status-badge` — Status badges
- [x] `.priority-badge` — Priority badges
- [x] `.bug-card` — Bug card
- [x] `.project-card` — Project card
- [x] `.stat-card` — Stat card
- [x] `.dashboard-page` — Dashboard layout
- [x] `.page-header` — Page header
- [x] `.page-title` — Page title
- [x] `.empty-state` — Empty state styling
- [x] `.pagination` — Pagination
- [x] `.page-link` — Pagination links
- [x] `.filter-bar` — Filter UI
- [x] `.comment-item` — Comments
- [x] `.sidebar-card` — Sidebar cards

### ⚠️ Used Incorrectly (Fix Required):
- [x] `text-gray-700` — Replace with `text-gray-300`
- [x] `border-gray-300` — Replace with `border-gray-600`
- [x] `bg-white` — Replace with `bg-gray-900` or `bg-gray-800`
- [x] `text-indigo-*` — Replace with `text-orange-*`
- [x] `border-indigo-*` — Replace with `border-orange-*`
- [x] `focus:ring-indigo-*` — Replace with `focus:ring-orange-*`
- [x] Inline styles in StatusBadge — Replace with CSS classes

---

## 🎨 Color System Reference

### Orange (Primary Accent)
```
orange-300: #fed7aa
orange-400: #fb923c
orange-500: #f97316  ← Use this
orange-600: #ea580c
```

### Gray Scale (Dark Theme)
```
gray-300: #d1d5db  (Light text)
gray-400: #9ca3af  (Muted text)
gray-500: #6b7280  (Disabled)
gray-600: #4b5563  (Borders)
gray-700: #374151  (Light backgrounds)
gray-800: #1f2937  (Medium backgrounds)
gray-900: #111827  (Dark backgrounds)
```

### Status Colors
```
Blue:   border-blue-700/50, bg-blue-900/20
Red:    border-red-700/50, bg-red-900/20
Amber:  border-amber-700/50, bg-amber-900/20
Green:  border-green-700/50, bg-green-900/20
Purple: border-purple-700/50, bg-purple-900/20
```

---

## Priority Order for Fixes

1. **HIGHEST** - Delete TextInput.vue + Update button components (5 min)
2. **HIGH** - Fix navigation components (10 min)
3. **HIGH** - Fix StatusBadge.vue (15 min)
4. **MEDIUM** - Fix other warnings (10 min)
5. **LOW** - Run tests and verify (30 min)

**Total Estimated Time:** 70 minutes

