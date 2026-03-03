<template>
    <AdminLayout>
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">Changelog</h1>
                <p class="text-slate-400 mt-1">{{ gameName }}</p>
            </div>
            <div class="flex gap-3">
                <router-link
                    :to="`/admin/games/${gameId}/changelog/new`"
                    class="bg-primary hover:bg-primary-dark text-white font-semibold px-4 py-2 rounded-lg transition"
                >
                    Add Entry
                </router-link>
                <router-link
                    to="/admin/games"
                    class="px-4 py-2 text-slate-400 hover:text-white transition"
                >
                    Back
                </router-link>
            </div>
        </div>
        <div class="bg-surface-light border border-slate-800 rounded-xl overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-800">
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Version</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Title</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Category</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Date</th>
                        <th class="text-right px-6 py-3 text-slate-400 text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="entry in entries" :key="entry.id" class="border-b border-slate-800/50">
                        <td class="px-6 py-4">
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-primary/20 text-primary-light">v{{ entry.version }}</span>
                        </td>
                        <td class="px-6 py-4">{{ entry.title }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded text-xs font-medium"
                                :class="categoryClass(entry.category)"
                            >
                                {{ categoryLabel(entry.category) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-400">{{ formatDate(entry.published_at) }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <router-link :to="`/admin/games/${gameId}/changelog/${entry.id}/edit`" class="text-primary hover:text-primary-light transition">Edit</router-link>
                            <button @click="deleteEntry(entry)" class="text-red-400 hover:text-red-300 transition">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!entries.length">
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">No changelog entries yet.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import AdminLayout from './AdminLayout.vue';
import { apiFetch } from '../../stores/auth.js';

const route = useRoute();
const gameId = route.params.id;
const gameName = ref('');
const entries = ref([]);

function categoryClass(cat) {
    const map = {
        feature: 'bg-green-500/20 text-green-400',
        bug_fix: 'bg-red-500/20 text-red-400',
        improvement: 'bg-blue-500/20 text-blue-400',
        balance: 'bg-yellow-500/20 text-yellow-400',
    };
    return map[cat] || 'bg-slate-500/20 text-slate-400';
}

function categoryLabel(cat) {
    const map = { feature: 'Feature', bug_fix: 'Bug Fix', improvement: 'Improvement', balance: 'Balance' };
    return map[cat] || cat;
}

function formatDate(dateStr) {
    return new Date(dateStr).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
}

async function loadData() {
    const [gameRes, entriesRes] = await Promise.all([
        apiFetch(`/api/admin/games/${gameId}`),
        apiFetch(`/api/admin/games/${gameId}/changelog`),
    ]);
    if (gameRes.ok) {
        const game = await gameRes.json();
        gameName.value = game.name;
    }
    if (entriesRes.ok) entries.value = await entriesRes.json();
}

async function deleteEntry(entry) {
    if (!confirm(`Delete "${entry.title}"?`)) return;
    const res = await apiFetch(`/api/admin/games/${gameId}/changelog/${entry.id}`, { method: 'DELETE' });
    if (res.ok) entries.value = entries.value.filter(e => e.id !== entry.id);
}

onMounted(loadData);
</script>
