<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Sign In" />

        <!-- Success message -->
        <div v-if="status" class="mb-6 p-4 bg-green-500/20 border border-green-500/50 text-green-300 rounded-lg text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ status }}
        </div>

        <!-- Title -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-white">Welcome back</h2>
            <p class="text-gray-400 text-sm mt-2">Sign in to your BugHive account</p>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <!-- Email field -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                        placeholder="Enter your email"
                    />
                </div>
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Password field -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        class="w-full pl-10 pr-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                        placeholder="Enter your password"
                    />
                </div>
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Remember me -->
            <div class="flex items-center">
                <input
                    id="remember"
                    type="checkbox"
                    v-model="form.remember"
                    class="w-4 h-4 bg-gray-700 border-gray-600 rounded focus:ring-2 focus:ring-orange-500 cursor-pointer"
                />
                <label for="remember" class="ms-3 text-sm text-gray-300 cursor-pointer">
                    Keep me signed in
                </label>
            </div>

            <!-- Submit button -->
            <button
                type="submit"
                :disabled="form.processing"
                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                class="w-full py-3 px-4 bg-orange-500 hover:bg-orange-600 disabled:hover:bg-orange-500 text-white font-semibold rounded-lg transition-colors flex items-center justify-center gap-2"
            >
                <svg v-if="!form.processing" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <svg v-else class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                {{ form.processing ? 'Signing in...' : 'Sign In' }}
            </button>
        </form>

        <!-- Forgot password link -->
        <div v-if="canResetPassword" class="mt-6 text-center">
            <Link
                :href="route('password.request')"
                class="text-sm text-gray-400 hover:text-orange-500 transition-colors font-medium flex items-center justify-center gap-1"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01m-6.993-5.679a6.002 6.002 0 010 11.358H3v-2h.341a4.002 4.002 0 100-8v-2C3 3.373 4.582 2 6.507 2h.493C9.37 2 11 3.58 11 5.5v2.009" />
                </svg>
                Forgot your password?
            </Link>
        </div>

        <!-- Divider -->
        <div class="my-8 relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-gray-800/50 text-gray-500">Or continue as</span>
            </div>
        </div>

        <!-- Demo login -->
        <button
            @click="() => { form.email = 'admin@bughive.dev'; form.password = 'password'; submit(); }"
            type="button"
            class="w-full py-3 px-4 bg-gray-700/50 hover:bg-gray-700 border border-gray-600 text-gray-200 font-medium rounded-lg transition-colors flex items-center justify-center gap-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Quick Demo (admin@bughive.dev)
        </button>
    </GuestLayout>
</template>
