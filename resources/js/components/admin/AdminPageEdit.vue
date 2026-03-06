<template>
    <AdminLayout>
        <div class="max-w-6xl">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold">Edit Page</h1>
                <div class="flex items-center gap-3">
                    <span v-if="saved" class="text-sm text-emerald-400 transition">Saved</span>
                    <router-link to="/admin/pages" class="px-4 py-2 text-slate-400 hover:text-white transition text-sm">Cancel</router-link>
                    <button type="button" @click="handleSubmit" :disabled="saving" class="bg-primary hover:bg-primary-dark text-white font-semibold px-5 py-2 rounded-lg transition disabled:opacity-50 text-sm">
                        {{ saving ? 'Saving...' : 'Save' }}
                    </button>
                </div>
            </div>

            <div v-if="loading" class="flex items-center justify-center py-32">
                <div class="w-8 h-8 border-2 border-primary/30 border-t-primary rounded-full animate-spin"></div>
            </div>

            <form v-else @submit.prevent="handleSubmit" class="space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm text-slate-400 mb-1">Title</label>
                        <input v-model="form.title" required class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
                    </div>
                    <div>
                        <label class="block text-sm text-slate-400 mb-1">Slug</label>
                        <input v-model="form.slug" required class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-slate-400 mb-1">Content</label>
                    <ContentEditor v-model="form.content" />
                </div>

                <div v-if="error" class="text-red-400 text-sm">{{ error }}</div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import AdminLayout from './AdminLayout.vue';
import ContentEditor from './ContentEditor.vue';
import { apiFetch } from '../../stores/auth.js';

const route = useRoute();
const router = useRouter();
const saving = ref(false);
const saved = ref(false);
const loading = ref(true);
const error = ref('');

const form = ref({
    title: '',
    slug: '',
    content: '',
});

onMounted(async () => {
    const res = await apiFetch(`/api/admin/pages/${route.params.id}`);
    if (res.ok) form.value = await res.json();
    loading.value = false;
});

async function handleSubmit() {
    saving.value = true;
    saved.value = false;
    error.value = '';
    try {
        const res = await apiFetch(`/api/admin/pages/${route.params.id}`, {
            method: 'PUT',
            body: JSON.stringify(form.value),
        });
        if (res.ok) {
            saved.value = true;
            setTimeout(() => saved.value = false, 2000);
        } else {
            const data = await res.json();
            error.value = data.message || 'Failed to save';
        }
    } finally {
        saving.value = false;
    }
}
</script>
