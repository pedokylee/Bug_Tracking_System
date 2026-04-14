<script setup>
import { ref, onMounted } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import { publicApi } from '@/Services/api'

// No layout — uses GuestLayout implicitly (no auth required)

const stats = ref(null)

onMounted(async () => {
  try {
    const res = await publicApi.getStats()
    stats.value = res.data
  } catch (e) {
    // silently fail — landing page still works
  }
})
</script>

<template>
  <Head title="BugHive — Professional Bug Tracking" />

  <div class="landing">
    <nav class="landing-nav">
      <div class="landing-brand">
        <span>🐛</span> BugHive
      </div>
      <div class="landing-nav-actions">
        <Link :href="route('login')" class="nav-link">Sign In</Link>
        <Link :href="route('register')" class="btn-primary">Get Started</Link>
      </div>
    </nav>

    <section class="hero">
      <h1 class="hero-title">Track bugs.<br>Ship faster.</h1>
      <p class="hero-subtitle">
        BugHive is a powerful, team-friendly bug tracking system
        designed for agile development workflows.
      </p>
      <div class="hero-actions">
        <Link :href="route('register')" class="btn-hero-primary">Start Tracking Free</Link>
        <Link :href="route('login')" class="btn-hero-secondary">Sign In</Link>
      </div>
    </section>

    <!-- Live stats from public API via Axios -->
    <section v-if="stats" class="live-stats">
      <div class="live-stats-grid">
        <div class="live-stat">
          <p class="live-stat__value">{{ stats.total_bugs.toLocaleString() }}</p>
          <p class="live-stat__label">Bugs Tracked</p>
        </div>
        <div class="live-stat">
          <p class="live-stat__value">{{ stats.total_projects }}</p>
          <p class="live-stat__label">Active Projects</p>
        </div>
        <div class="live-stat">
          <p class="live-stat__value">{{ stats.resolved_today }}</p>
          <p class="live-stat__label">Resolved Today</p>
        </div>
      </div>
    </section>

    <!-- Features -->
    <section class="features">
      <h2 class="features-title">Everything you need</h2>
      <div class="features-grid">
        <div class="feature-card" v-for="f in features" :key="f.title">
          <div class="feature-icon">{{ f.icon }}</div>
          <h3>{{ f.title }}</h3>
          <p>{{ f.desc }}</p>
        </div>
      </div>
    </section>

    <footer class="landing-footer">
      <p>© {{ new Date().getFullYear() }} BugHive. Built with Laravel, Inertia.js, Vue 3.</p>
    </footer>
  </div>
</template>

<script>
const features = [
  { icon: '🔍', title: 'Full CRUD', desc: 'Create, view, edit and delete bugs with rich detail forms and real-time validation.' },
  { icon: '🛡️', title: 'Role Middleware', desc: 'Route protection with role-based access control and project membership enforcement.' },
  { icon: '⚡', title: 'Inertia.js', desc: 'Single-page app feel with server-side routing — no separate API needed.' },
  { icon: '📡', title: 'Public API + Axios', desc: 'RESTful API endpoints consumed via Axios for live stats and integrations.' },
  { icon: '🎨', title: 'Responsive Design', desc: 'Fully responsive layout that works on mobile, tablet, and desktop.' },
  { icon: '🗄️', title: 'Database Seeders', desc: 'Mock data seeders for statuses, users, projects and bugs for instant setup.' },
]
</script>