<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

defineOptions({ layout: AppLayout });
</script>

<template>
    <Head title="Profile" />

    <div class="dashboard-page">
        <div class="page-header">
            <div>
                <h1 class="page-title">Profile Settings</h1>
                <p class="page-subtitle">Manage your account and preferences</p>
            </div>
        </div>

        <div class="space-y-6 max-w-4xl">
            <div class="bg-gray-800/50 backdrop-blur-xl border border-gray-700 rounded-2xl p-8">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-2xl"
                />
            </div>

            <div class="bg-gray-800/50 backdrop-blur-xl border border-gray-700 rounded-2xl p-8">
                <UpdatePasswordForm class="max-w-2xl" />
            </div>

            <div class="bg-gray-800/50 backdrop-blur-xl border border-gray-700 rounded-2xl p-8">
                <DeleteUserForm class="max-w-2xl" />
            </div>
        </div>
    </div>
</template>
