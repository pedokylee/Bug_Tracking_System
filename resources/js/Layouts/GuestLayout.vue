<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 flex flex-col items-center justify-center px-4">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-orange-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 w-full max-w-md">
            <!-- Logo -->
            <Link href="/" class="flex justify-center mb-8">
                <div class="flex items-center gap-2">
                    <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-2xl font-bold text-white">BugHive</span>
                </div>
            </Link>

            <!-- Form card -->
            <div class="bg-gray-800/50 backdrop-blur-xl border border-gray-700 rounded-2xl shadow-2xl px-8 py-8">
                <slot />
            </div>

            <!-- Footer link -->
            <p class="text-center text-gray-400 text-sm mt-6">
                <span>Don't have an account?</span>
                <Link href="/register" class="text-orange-500 hover:text-orange-400 font-semibold ml-1">Sign up</Link>
            </p>
        </div>
    </div>
</template>
