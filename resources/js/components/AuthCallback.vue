<template>
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <div v-if="!error" class="w-12 h-12 border-2 border-primary/30 border-t-primary rounded-full animate-spin mx-auto mb-4"></div>
            <p v-if="error" class="text-red-400">{{ error }}</p>
            <p v-else class="text-gray-500">Signing you in...</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { handleCallback } from '../stores/userAuth.js';

const route = useRoute();
const router = useRouter();
const error = ref('');

onMounted(async () => {
    try {
        const code = route.query.code;
        const state = route.query.state;
        if (!code) {
            error.value = 'No authorization code received';
            return;
        }
        const returnUrl = await handleCallback(code, state);
        router.replace(returnUrl);
    } catch (e) {
        error.value = e.message || 'Authentication failed';
    }
});
</script>
