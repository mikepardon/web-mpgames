<template>
    <AdminLayout>
        <h1 class="text-3xl font-bold mb-8">{{ isEdit ? 'Edit Changelog Entry' : 'New Changelog Entry' }}</h1>
        <form @submit.prevent="handleSubmit" class="max-w-2xl space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-slate-400 mb-1">Version</label>
                    <input v-model="form.version" required placeholder="1.2.0" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
                </div>
                <div>
                    <label class="block text-sm text-slate-400 mb-1">Category</label>
                    <select v-model="form.category" required class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary">
                        <option value="feature">Feature</option>
                        <option value="bug_fix">Bug Fix</option>
                        <option value="improvement">Improvement</option>
                        <option value="balance">Balance</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Title</label>
                <input v-model="form.title" required class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Description</label>
                <textarea v-model="form.description" required rows="6" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary"></textarea>
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Published Date</label>
                <input v-model="form.published_at" required type="date" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
            </div>
            <div v-if="error" class="text-red-400 text-sm">{{ error }}</div>
            <div class="flex gap-4">
                <button type="submit" :disabled="saving" class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2 rounded-lg transition disabled:opacity-50">
                    {{ saving ? 'Saving...' : 'Save' }}
                </button>
                <router-link :to="`/admin/games/${gameId}/changelog`" class="px-6 py-2 text-slate-400 hover:text-white transition">Cancel</router-link>
            </div>
        </form>
    </AdminLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import AdminLayout from './AdminLayout.vue';
import { apiFetch } from '../../stores/auth.js';

const route = useRoute();
const router = useRouter();
const gameId = route.params.id;
const entryId = route.params.entryId;
const isEdit = computed(() => !!entryId);
const saving = ref(false);
const error = ref('');

const form = ref({
    version: '',
    title: '',
    description: '',
    published_at: new Date().toISOString().split('T')[0],
    category: 'feature',
});

onMounted(async () => {
    if (isEdit.value) {
        const res = await apiFetch(`/api/admin/games/${gameId}/changelog/${entryId}`);
        if (res.ok) {
            const data = await res.json();
            form.value = {
                version: data.version,
                title: data.title,
                description: data.description,
                published_at: data.published_at?.split('T')[0] || data.published_at,
                category: data.category,
            };
        }
    }
});

async function handleSubmit() {
    saving.value = true;
    error.value = '';
    try {
        const url = isEdit.value
            ? `/api/admin/games/${gameId}/changelog/${entryId}`
            : `/api/admin/games/${gameId}/changelog`;
        const method = isEdit.value ? 'PUT' : 'POST';
        const res = await apiFetch(url, {
            method,
            body: JSON.stringify(form.value),
        });
        if (res.ok) {
            router.push(`/admin/games/${gameId}/changelog`);
        } else {
            const data = await res.json();
            error.value = data.message || 'Failed to save';
        }
    } finally {
        saving.value = false;
    }
}
</script>
