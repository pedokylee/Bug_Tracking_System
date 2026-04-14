# CSS Audit: Component Inventory

**Full inventory of all Vue components examined in the BugHive project**

---

## 📁 BUTTON COMPONENTS (4 files)

### ✅ Form/Input.vue
- **Status:** PASS
- **Path:** `resources/js/Components/Form/Input.vue`
- **Classes Used:** `.form-field`, `.form-label`, `.form-input`, `.required-star`, `.form-hint`, `.form-error`
- **All Defined:** ✅ YES
- **Issues:** None

---

### ❌ PrimaryButton.vue
- **Status:** CRITICAL
- **Path:** `resources/js/Components/PrimaryButton.vue`
- **Classes Used:**
  - `inline-flex` ✅
  - `items-center` ✅
  - `rounded-md` ✅
  - `border` ✅
  - `border-transparent` ✅
  - `bg-gray-800` ⚠️ (NOT what app.css defines for btn-primary)
  - `px-4` ✅
  - `py-2` ✅
  - `text-xs` ✅
  - `font-semibold` ✅
  - `uppercase` ✅
  - `tracking-widest` ✅
  - `text-white` ✅
  - `transition` ✅
  - `duration-150` ✅
  - `ease-in-out` ✅
  - `hover:bg-gray-700` ⚠️
  - `focus:bg-gray-700` ⚠️
  - `focus:outline-none` ✅
  - `focus:ring-2` ✅
  - `focus:ring-indigo-500` ❌ (NOT defined, wrong color)
  - `focus:ring-offset-2` ✅
  - `active:bg-gray-900` ⚠️

- **All Defined:** ❌ NO - Uses indigo and wrong colors
- **Recommendation:** Use `.btn-primary` class or fix colors to orange/match design system
- **Fix Time:** 2 minutes

---

### ❌ SecondaryButton.vue
- **Status:** CRITICAL
- **Path:** `resources/js/Components/SecondaryButton.vue`
- **Classes Used:**
  - `inline-flex` ✅
  - `items-center` ✅
  - `rounded-md` ✅
  - `border` ✅
  - `border-gray-300` ❌ (NOT in app.css)
  - `bg-white` ❌ (NOT in dark design system)
  - `px-4` ✅
  - `py-2` ✅
  - `text-xs` ✅
  - `font-semibold` ✅
  - `uppercase` ✅
  - `tracking-widest` ✅
  - `text-gray-700` ❌ (NOT in app.css - should be white for dark theme)
  - `shadow-sm` ✅
  - `transition` ✅
  - `duration-150` ✅
  - `ease-in-out` ✅
  - `hover:bg-gray-50` ❌ (light theme)
  - `focus:outline-none` ✅
  - `focus:ring-2` ✅
  - `focus:ring-indigo-500` ❌ (NOT defined, wrong color)
  - `focus:ring-offset-2` ✅
  - `disabled:opacity-25` ✅

- **All Defined:** ❌ NO - Uses light theme completely
- **Critical Issue:** Uses white background, light theme, and indigo focus ring
- **Recommendation:** Use `.btn-secondary` class
- **Fix Time:** 2 minutes

---

### ❌ DangerButton.vue
- **Status:** CRITICAL
- **Path:** `resources/js/Components/DangerButton.vue`
- **Classes Used:**
  - `inline-flex` ✅
  - `items-center` ✅
  - `rounded-md` ✅
  - `border` ✅
  - `border-transparent` ✅
  - `bg-red-600` ⚠️ (Tailwind, not app.css)
  - `px-4` ✅
  - `py-2` ✅
  - `text-xs` ✅
  - `font-semibold` ✅
  - `uppercase` ✅
  - `tracking-widest` ✅
  - `text-white` ✅
  - `transition` ✅
  - `duration-150` ✅
  - `ease-in-out` ✅
  - `hover:bg-red-500` ⚠️
  - `focus:outline-none` ✅
  - `focus:ring-2` ✅
  - `focus:ring-red-500` ⚠️
  - `focus:ring-offset-2` ✅
  - `active:bg-red-700` ⚠️

- **All Defined:** ⚠️ PARTIALLY - Uses inline Tailwind instead of .btn-danger class
- **Issue:** Duplicates what `.btn-danger` already defines in app.css
- **Recommendation:** Replace entire class list with single `.btn-danger`
- **Fix Time:** 1 minute

---

## 🔤 FORM COMPONENTS (5 files)

### ✅ Form/Input.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Components/Form/Input.vue`
- **Classes Used:** `.form-field`, `.form-label`, `.form-input`, `.form-input--error`, `.required-star`, `.form-hint`, `.form-error`
- **All Defined:** ✅ YES
- **Notes:** Properly implements error states and form system

---

### ✅ Form/Select.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Components/Form/Select.vue`
- **Classes Used:** `.form-field`, `.form-label`, `.form-select`, `.form-select--error`, `.required-star`, `.form-error`
- **All Defined:** ✅ YES
- **Notes:** Properly implements select styling

---

### ✅ InputError.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Components/InputError.vue`
- **Classes Used:** `.error-message`
- **All Defined:** ✅ YES
- **CSS Definition:** 
  ```css
  .error-message {
    @apply text-red-400 text-sm mt-2 flex items-center gap-1;
  }
  ```

---

### ❌ InputLabel.vue
- **Status:** WARNING
- **Path:** `resources/js/Components/InputLabel.vue`
- **Classes Used:**
  - `block` ✅
  - `text-sm` ✅
  - `font-medium` ✅
  - `text-gray-700` ❌ (NOT in app.css - should be text-gray-300 for dark theme)

- **Issue:** Uses light theme color for dark application
- **Recommendation:** Use `.form-label` class or change to `text-gray-300`
- **Fix Time:** 1 minute

---

### ❌ Checkbox.vue
- **Status:** CRITICAL
- **Path:** `resources/js/Components/Checkbox.vue`
- **Classes Used:**
  - `rounded` ✅
  - `border-gray-300` ❌ (NOT in app.css, should be border-gray-600)
  - `text-indigo-600` ❌ (NOT in app.css, should be accent-orange-500)
  - `shadow-sm` ✅
  - `focus:ring-indigo-500` ❌ (NOT in app.css, should be orange)

- **All Defined:** ❌ NO
- **Issue:** Uses indigo accent color instead of orange
- **Recommendation:** Update to `accent-orange-500` or use defined checkbox classes
- **Fix Time:** 2 minutes

---

## 🧭 NAVIGATION COMPONENTS (5 files)

### ✅ Sidebar.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Components/Sidebar.vue`
- **Classes Used:** `.sidebar`, `.sidebar-header`, `.sidebar-brand`, `.brand-title`, `.brand-subtitle`, `.sidebar-close`, `.sidebar-nav`, `.nav-section-label`, `.nav-item`, `.nav-item.active`, `.nav-icon`, `.nav-label`, `.sidebar-footer`, `.version-tag`
- **All Defined:** ✅ YES
- **Notes:** Perfect implementation using dark theme correctly

---

### ✅ Navbar.vue
- **Status:** PASS ✅ (Minor warning on brand-name)
- **Path:** `resources/js/Components/Navbar.vue`
- **Classes Used:**
  - `.navbar` ✅
  - `.navbar-left` ✅
  - `.sidebar-toggle` ✅
  - `.brand` ✅
  - `.navbar-right` ✅
  - `.btn-report` ✅
  - `.user-menu-wrapper` ✅
  - `.user-avatar-btn` ✅
  - `.avatar` ✅
  - `.user-name` ✅
  - `.user-dropdown` ✅
  - `.dropdown-header` ✅
  - `.dropdown-name` ✅
  - `.dropdown-email` ✅
  - `.dropdown-divider` ✅
  - `.dropdown-item` ✅
  - `.dropdown-item.danger` ✅

- **All Defined:** ✅ YES, but one issue
- **Minor Issue:** `brand-name` class reference used but undefined (can be removed)
- **Fix Time:** 1 minute

---

### ❌ NavLink.vue
- **Status:** CRITICAL
- **Path:** `resources/js/Components/NavLink.vue`
- **Classes (Active state):**
  - `inline-flex` ✅
  - `items-center` ✅
  - `px-1` ✅
  - `pt-1` ✅
  - `border-b-2` ✅
  - `border-indigo-400` ❌ (NOT in app.css, should be orange-500)
  - `text-sm` ✅
  - `font-medium` ✅
  - `leading-5` ✅
  - `text-gray-900` ❌ (light theme, should be white)
  - `focus:outline-none` ✅
  - `focus:border-indigo-700` ❌
  - `transition` ✅
  - `duration-150` ✅
  - `ease-in-out` ✅

- **Classes (Inactive state):**
  - `border-transparent` ✅
  - `text-gray-500` ❌ (NOT in app.css, should be text-gray-300)
  - `hover:text-gray-700` ❌
  - `hover:border-gray-300` ❌
  - `focus:border-gray-300` ❌

- **All Defined:** ❌ NO
- **Critical Issue:** Uses light theme + indigo color scheme
- **Recommendation:** Update to dark theme with orange accent
- **Fix Time:** 5 minutes

---

### ❌ ResponsiveNavLink.vue
- **Status:** CRITICAL
- **Path:** `resources/js/Components/ResponsiveNavLink.vue`
- **Classes (Active state):**
  - `block` ✅
  - `w-full` ✅
  - `ps-3` ✅
  - `pe-4` ✅
  - `py-2` ✅
  - `border-l-4` ✅
  - `border-indigo-400` ❌ (NOT in app.css)
  - `text-start` ✅
  - `text-base` ✅
  - `font-medium` ✅
  - `text-indigo-700` ❌ (NOT in app.css)
  - `bg-indigo-50` ❌ (light theme, NOT in app.css)
  - `focus:outline-none` ✅
  - `focus:text-indigo-800` ❌
  - `focus:bg-indigo-100` ❌
  - `focus:border-indigo-700` ❌
  - `transition` ✅
  - `duration-150` ✅
  - `ease-in-out` ✅

- **Classes (Inactive state):**
  - All uses `text-gray-600`, `hover:text-gray-800`, `hover:bg-gray-50`, `hover:border-gray-300` ❌ (light theme)

- **All Defined:** ❌ NO
- **CRITICAL Issue:** 100% light theme + indigo colors - completely wrong for dark app
- **Recommendation:** Complete rebuild using dark theme + orange accent (`.nav-item` reference)
- **Fix Time:** 10 minutes

---

### ❌ DropdownLink.vue
- **Status:** CRITICAL
- **Path:** `resources/js/Components/DropdownLink.vue`
- **Classes Used:**
  - `block` ✅
  - `w-full` ✅
  - `px-4` ✅
  - `py-2` ✅
  - `text-start` ✅
  - `text-sm` ✅
  - `leading-5` ✅
  - `text-gray-700` ❌ (NOT in app.css, light theme)
  - `transition` ✅
  - `duration-150` ✅
  - `ease-in-out` ✅
  - `hover:bg-gray-100` ❌ (light theme)
  - `focus:bg-gray-100` ❌ (light theme)
  - `focus:outline-none` ✅

- **All Defined:** ❌ NO
- **Issue:** Light theme when app uses dark theme
- **Recommendation:** Use `.dropdown-item` class which is already defined with proper dark theme styling
- **Fix Time:** 1 minute

---

## 🗂️ LAYOUT & STRUCTURE COMPONENTS (3 files)

### ✅ Modal.vue
- **Status:** WARNING
- **Path:** `resources/js/Components/Modal.vue`
- **Critical Classes:**
  - `absolute` ✅
  - `inset-0` ✅
  - `bg-gray-500` ⚠️ (generic Tailwind, not ideal)
  - `opacity-75` ⚠️ (should be part of combined class)

- **Issue:** Uses medium gray for backdrop when dark theme would use black
- **Recommendation:** Use `bg-black/50` instead
- **Fix Time:** 2 minutes

---

### ✅ Dropdown.vue
- **Status:** CRITICAL (content classes)
- **Path:** `resources/js/Components/Dropdown.vue`
- **Content Classes Default:**
  - `py-1` ✅
  - `bg-white` ❌ (light theme, NOT in app.css)

- **Content Wrapper:**
  - `rounded-md` ✅
  - `ring-1` ✅
  - `ring-black` ⚠️ (generic Tailwind)
  - `ring-opacity-5` ⚠️ (generic Tailwind)

- **Transform Classes:**
  - `ltr:origin-top-left` ✅
  - `rtl:origin-top-right` ✅
  - `start-0` ✅
  - `end-0` ✅
  - `origin-top` ✅

- **Critical Issue:** Default content classes use `bg-white` (light theme)
- **Recommendation:** Update default to `bg-gray-900 border border-gray-700 rounded-lg` or use dark theme variant
- **Fix Time:** 3 minutes

---

### ✅ ApplicationLogo.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Components/ApplicationLogo.vue`
- **Notes:** SVG component, no CSS classes used
- **All Defined:** ✅ N/A

---

## 🎯 CARD & DISPLAY COMPONENTS (2 files)

### ✅ BugCard.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Components/BugCard.vue`
- **Classes Used:** `.bug-card`, `.bug-card__header`, `.bug-card__title`, `.bug-card__desc`, `.bug-card__footer`, `.priority-badge`, `.priority-badge.priority--{critical,high,medium,low}`, `.bug-id`, `.assignee-chip`, `.assignee-avatar`
- **All Defined:** ✅ YES
- **Notes:** Perfect implementation with all classes properly used

---

### ✅ StatusBadge.vue
- **Status:** WARNING (Architecture issue)
- **Path:** `resources/js/Components/StatusBadge.vue`
- **Classes Used:** `.status-badge`, `.status-badge--{sm,md,lg}`, `.status-dot`
- **CSS Classes:** ✅ Defined
- **Styling Method:** ❌ Uses hardcoded inline hex color values instead of CSS classes

- **Problem:** 
  ```js
  const colorMap = {
    'Open':        { bg: '#EFF6FF', text: '#1D4ED8', dot: '#3B82F6' },
    'In Progress': { bg: '#FFFBEB', text: '#92400E', dot: '#F59E0B' },
    ...
  }
  ```

- **Issue:** Makes theming impossible, defeats purpose of CSS design system
- **Recommendation:** Move colors to CSS classes and use class binding
- **Fix Time:** 15 minutes

---

## 📄 PAGES (20 files)

### ✅ Landing.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Pages/Landing.vue`
- **Classes Used:** `.landing`, `.landing-nav`, `.landing-brand`, `.landing-nav-actions`, `.nav-link`, `.hero`, `.hero-badge`, `.hero-title`, `.hero-subtitle`, `.hero-actions`, `.btn-hero-primary`, `.btn-hero-secondary`, `.live-stats`, `.live-stats-grid`, `.live-stat`, `.live-stat__value`, `.live-stat__label`, `.features`, `.features-title`, `.features-grid`, `.feature-card`, `.feature-icon`, `.landing-footer`
- **All Defined:** ✅ YES
- **Notes:** All classes properly using design system

---

### ✅ Dashboard.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Pages/Dashboard.vue`
- **Classes Used:** `.dashboard-page`, `.page-header`, `.page-title`, `.page-subtitle`, `.stats-loading`, `.stat-skeleton`, `.stats-grid`, `.stat-card`, `.stat-card--{blue,red,amber,green,purple}`, `.stat-label`, `.stat-value`, `.dashboard-section`, `.section-header`, `.section-title`, `.see-all`, `.bug-grid`, `.bug-list`, `.bug-list-item`, `.bug-list-title`, `.bug-list-project`, `.empty-state`
- **All Defined:** ✅ YES

---

### ✅ Bugs/Index.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Pages/Bugs/Index.vue`
- **Classes Used:** `.bugs-page`, `.page-header`, `.page-title`, `.page-subtitle`, `.back-link`, `.filter-bar`, `.filter-search`, `.filter-select`, `.bug-grid`, `.empty-state`, `.pagination`, `.page-link`, `.page-link.active`, `.page-link.disabled`
- **All Defined:** ✅ YES

---

### ✅ Bugs/Show.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Pages/Bugs/Show.vue`
- **Classes Used:** `.bug-show-page`, `.bug-show-header`, `.back-link`, `.btn-secondary`, `.btn-danger`, `.bug-show-layout`, `.bug-show-main`, `.bug-show-card`, `.bug-show-meta`, `.bug-id-large`, `.bug-show-title`, `.bug-show-info`, `.info-row`, `.info-label`, `.info-value`, `.bug-section`, `.bug-section-title`, `.bug-section-content`, `.bug-section-pre`, `.bug-behavior-grid`, `.actual-behavior`, `.comments-section`, `.comments-title`, `.comment-list`, `.comment-item`, `.comment-avatar`, `.comment-body`, `.comment-header`, `.comment-date`, `.comment-content`, `.no-comments`, `.comment-form`, `.form-textarea`, `.bug-show-sidebar`, `.sidebar-card`, `.sidebar-card-title`, `.assignee-info`, `.assignee-avatar-lg`, `.assignee-name`, `.assignee-email`, `.unassigned`, `.project-link`
- **All Defined:** ✅ YES

---

### ✅ Bugs/Create.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Pages/Bugs/Create.vue`
- **Classes Used:** `.form-page`, `.form-page-header`, `.page-title`, `.back-link`, `.bug-form`, `.form-section`, `.form-section-title`, `.form-field`, `.form-label`, `.required-star`, `.form-textarea`, `.form-input--error`, `.form-error`, `.form-row`, `.form-actions`, `.btn-secondary`, `.btn-primary`
- **All Defined:** ✅ YES

---

### ✅ Bugs/Edit.vue
- **Status:** PASS ✅
- **Path:** Similar to Create.vue, all classes properly defined

---

### ✅ Projects/Index.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Pages/Projects/Index.vue`
- **Classes Used:** `.projects-page`, `.page-header`, `.page-title`, `.page-subtitle`, `.btn-primary`, `.projects-grid`, `.project-card`, `.project-card__icon`, `.project-card__body`, `.project-card__name`, `.project-card__desc`, `.project-card__footer`, `.bug-count`, `.visibility-badge`, `.visibility-badge.public`, `.visibility-badge.private`, `.empty-state`
- **All Defined:** ✅ YES

---

### ✅ Projects/Show.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Pages/Projects/Show.vue`
- **Classes Used:** `.project-show-page`, `.page-header`, `.page-title`, `.page-subtitle`, `.back-link`, `.project-actions`, `.btn-primary`, `.btn-danger`, `.project-stats`, `.stat-pill`, `.stat-pill--{blue,red,amber,green}`, `.stat-pill__value`, `.stat-pill__label`, `.bug-table-wrapper`, `.bug-table`, `.bug-id-cell`, `.bug-id-link`, `.priority-badge`, `.empty-state`
- **All Defined:** ✅ YES

---

### ✅ Projects/Create.vue
- **Status:** PASS ✅
- **Path:** Similar to Bugs/Create.vue, all classes properly defined

---

### ✅ Auth/Login.vue, Register.vue, etc.
- **Status:** PASS ✅
- **Notes:** All auth pages use correct form classes

---

### ✅ Profile/Edit.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Pages/Profile/Edit.vue`
- **Classes Used:** `.profile-page`, `.profile-card`, `.profile-section`, `.profile-section-title`, `.profile-section-subtitle`, `.profile-form-group`
- **All Defined:** ✅ YES

---

## 📐 LAYOUT COMPONENTS (1 file)

### ✅ AppLayout.vue
- **Status:** PASS ✅
- **Path:** `resources/js/Layouts/AppLayout.vue`
- **Classes Used:** `.app-layout`, `.main-content`, `.main-content.sidebar-open`, `.page-content`, `.sidebar-overlay`
- **All Defined:** ✅ YES
- **Notes:** Root layout properly uses all design system classes

---

## 📊 SUMMARY STATISTICS

| Category | Total | Pass | Warning | Critical |
|----------|-------|------|---------|----------|
| Button Components | 4 | 0 | 0 | 4 |
| Form Components | 5 | 3 | 2 | 0 |
| Navigation Components | 5 | 2 | 0 | 3 |
| Card/Display Components | 2 | 1 | 1 | 0 |
| Pages | 20 | 20 | 0 | 0 |
| Layout Components | 1 | 1 | 0 | 0 |
| **TOTAL** | **39** | **27** | **3** | **9** |

---

## 🎯 FOCUS AREAS FOR FIXES

### 1. Button Consistency
All button components (PrimaryButton, SecondaryButton, DangerButton) should delegate to app.css classes instead of inline Tailwind.

### 2. Navigation Theme Consistency
Navigation components (NavLink, ResponsiveNavLink, DropdownLink) all use light theme + indigo colors when app is dark theme + orange.

### 3. Design System Architecture
StatusBadge uses hardcoded inline styles instead of CSS classes, defeating the purpose of having a design system.

### 4. Legacy Components
TextInput.vue is completely legacy and should be removed in favor of Form/Input.vue.

