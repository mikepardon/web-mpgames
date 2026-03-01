<template>
    <AdminLayout>
        <h1 class="text-3xl font-bold mb-8">Edit Page</h1>
        <form @submit.prevent="handleSubmit" class="max-w-2xl space-y-6">
            <div>
                <label class="block text-sm text-slate-400 mb-1">Title</label>
                <input v-model="form.title" required class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Slug</label>
                <input v-model="form.slug" required class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Content</label>
                <textarea v-model="form.content" required rows="20" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary font-mono text-sm"></textarea>
            </div>
            <div v-if="error" class="text-red-400 text-sm">{{ error }}</div>
            <div class="flex gap-4">
                <button type="submit" :disabled="saving" class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2 rounded-lg transition disabled:opacity-50">
                    {{ saving ? 'Saving...' : 'Save' }}
                </button>
                <router-link to="/admin/pages" class="px-6 py-2 text-slate-400 hover:text-white transition">Cancel</router-link>
            </div>
        </form>
    </AdminLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import AdminLayout from './AdminLayout.vue';
import { apiFetch } from '../../stores/auth.js';

const route = useRoute();
const router = useRouter();
const saving = ref(false);
const error = ref('');

const form = ref({
    title: '',
    slug: '',
    content: '',
});

onMounted(async () => {
    const res = await apiFetch(`/api/admin/pages/${route.params.id}`);
    if (res.ok) form.value = await res.json();
});

async function handleSubmit() {
    saving.value = true;
    error.value = '';
    try {
        const res = await apiFetch(`/api/admin/pages/${route.params.id}`, {
            method: 'PUT',
            body: JSON.stringify(form.value),
        });
        if (res.ok) {
            router.push('/admin/pages');
        } else {
            const data = await res.json();
            error.value = data.message || 'Failed to save';
        }
    } finally {
        saving.value = false;
    }
}
</script>
