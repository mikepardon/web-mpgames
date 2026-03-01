<template>
    <AdminLayout>
        <h1 class="text-3xl font-bold mb-8">{{ isEdit ? 'Edit Game' : 'New Game' }}</h1>
        <form @submit.prevent="handleSubmit" class="max-w-2xl space-y-6">
            <div>
                <label class="block text-sm text-slate-400 mb-1">Name</label>
                <input v-model="form.name" required class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Slug</label>
                <input v-model="form.slug" required class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Short Description</label>
                <input v-model="form.short_description" required class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Description</label>
                <textarea v-model="form.description" required rows="6" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary"></textarea>
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Features (one per line)</label>
                <textarea v-model="featuresText" rows="4" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary"></textarea>
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-1">Play URL</label>
                <input v-model="form.play_url" required type="url" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-slate-400 mb-1">Logo URL</label>
                    <input v-model="form.logo_url" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
                </div>
                <div>
                    <label class="block text-sm text-slate-400 mb-1">Banner URL</label>
                    <input v-model="form.banner_url" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-slate-400 mb-1">Status</label>
                    <select v-model="form.status" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-slate-400 mb-1">Sort Order</label>
                    <input v-model.number="form.sort_order" type="number" class="w-full px-4 py-2 bg-surface border border-slate-700 rounded-lg text-white focus:outline-none focus:border-primary" />
                </div>
            </div>
            <div v-if="error" class="text-red-400 text-sm">{{ error }}</div>
            <div class="flex gap-4">
                <button type="submit" :disabled="saving" class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2 rounded-lg transition disabled:opacity-50">
                    {{ saving ? 'Saving...' : 'Save' }}
                </button>
                <router-link to="/admin/games" class="px-6 py-2 text-slate-400 hover:text-white transition">Cancel</router-link>
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
const isEdit = computed(() => !!route.params.id);
const saving = ref(false);
const error = ref('');

const form = ref({
    name: '',
    slug: '',
    short_description: '',
    description: '',
    features: [],
    play_url: '',
    logo_url: '',
    banner_url: '',
    status: 'draft',
    sort_order: 0,
});

const featuresText = computed({
    get: () => (form.value.features || []).join('\n'),
    set: (val) => { form.value.features = val.split('\n').filter(f => f.trim()); },
});

onMounted(async () => {
    if (isEdit.value) {
        const res = await apiFetch(`/api/admin/games/${route.params.id}`);
        if (res.ok) form.value = await res.json();
    }
});

async function handleSubmit() {
    saving.value = true;
    error.value = '';
    try {
        const url = isEdit.value ? `/api/admin/games/${route.params.id}` : '/api/admin/games';
        const method = isEdit.value ? 'PUT' : 'POST';
        const res = await apiFetch(url, {
            method,
            body: JSON.stringify(form.value),
        });
        if (res.ok) {
            router.push('/admin/games');
        } else {
            const data = await res.json();
            error.value = data.message || 'Failed to save';
        }
    } finally {
        saving.value = false;
    }
}
</script>
