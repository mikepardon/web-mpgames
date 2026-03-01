<template>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-surface-light border border-slate-800 rounded-xl p-8 w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Admin Login</h1>
            <form @submit.prevent="handleLogin">
                <div class="mb-4">
                    <label class="block text-sm text-slate-400 mb-1">Email</label>
                    <input
                        v-model="email"
                        type="email"
                        required
                        class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary"
                    />
                </div>
                <div class="mb-6">
                    <label class="block text-sm text-slate-400 mb-1">Password</label>
                    <input
                        v-model="password"
                        type="password"
                        required
                        class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary"
                    />
                </div>
                <div v-if="error" class="mb-4 text-red-400 text-sm">{{ error }}</div>
                <button
                    type="submit"
                    :disabled="loading"
                    class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2 rounded-lg transition disabled:opacity-50"
                >
                    {{ loading ? 'Logging in...' : 'Login' }}
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { login } from '../../stores/auth.js';

const router = useRouter();
const email = ref('');
const password = ref('');
const error = ref('');
const loading = ref(false);

async function handleLogin() {
    error.value = '';
    loading.value = true;
    try {
        await login(email.value, password.value);
        router.push('/admin');
    } catch (e) {
        error.value = e.message;
    } finally {
        loading.value = false;
    }
}
</script>
