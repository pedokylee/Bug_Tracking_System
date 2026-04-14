// resources/js/Services/api.js
// Axios configuration for consuming the public API endpoints

import axios from 'axios'

// Base axios instance with defaults
const api = axios.create({
    baseURL: '/api/v1',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
    withCredentials: true, // Include cookies for Sanctum auth
})

// Request interceptor — attach CSRF token automatically
api.interceptors.request.use((config) => {
    const token = document.cookie
        .split('; ')
        .find(row => row.startsWith('XSRF-TOKEN='))
        ?.split('=')[1]

    if (token) {
        config.headers['X-XSRF-TOKEN'] = decodeURIComponent(token)
    }

    return config
})

// Response interceptor — handle errors globally
api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            window.location.href = '/login'
        }

        if (error.response?.status === 403) {
            console.error('Forbidden: Insufficient permissions')
        }

        if (error.response?.status === 422) {
            // Validation errors — surface to component
            return Promise.reject(error.response.data.errors)
        }

        return Promise.reject(error)
    }
)

// ===================================================
// Bug API methods — used across Vue components
// ===================================================

export const bugApi = {
    /**
     * Fetch all bugs (optionally filtered)
     * Called from: Bugs/Index.vue
     */
    getAll(params = {}) {
        return api.get('/bugs', { params })
    },

    /**
     * Get a single bug by ID
     */
    getOne(id) {
        return api.get(`/bugs/${id}`)
    },

    /**
     * Create a new bug
     */
    create(data) {
        return api.post('/bugs', data)
    },

    /**
     * Update bug fields
     */
    update(id, data) {
        return api.patch(`/bugs/${id}`, data)
    },

    /**
     * Delete a bug
     */
    delete(id) {
        return api.delete(`/bugs/${id}`)
    },

    /**
     * Quick-update status (called from kanban drag-drop)
     */
    updateStatus(id, status) {
        return api.patch(`/bugs/${id}/status`, { status })
    },

    /**
     * Assign bug to a user
     */
    assign(id, assigneeId) {
        return api.patch(`/bugs/${id}/assign`, { assignee_id: assigneeId })
    },

    /**
     * Get bugs grouped by priority (dashboard chart)
     */
    getByPriority() {
        return api.get('/bugs/by-priority')
    },

    /**
     * Get bugs grouped by status (dashboard chart)
     */
    getByStatus() {
        return api.get('/bugs/by-status')
    },
}

// ===================================================
// Public API — no auth required
// ===================================================

export const publicApi = {
    /**
     * Fetch public dashboard stats
     * Called from: Dashboard.vue, Landing.vue
     */
    getStats() {
        return api.get('/stats')
    },

    /**
     * Get public project listing
     */
    getProjects() {
        return api.get('/projects')
    },
}

export default api