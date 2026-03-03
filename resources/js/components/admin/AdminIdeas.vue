<template>
    <AdminLayout>
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">Ideas</h1>
                <p class="text-slate-400 mt-1">{{ gameName }}</p>
            </div>
            <router-link to="/admin/games" class="px-4 py-2 text-slate-400 hover:text-white transition">
                Back
            </router-link>
        </div>
        <div class="bg-surface-light border border-slate-800 rounded-xl overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-800">
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Title</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Author</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Votes</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Comments</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Status</th>
                        <th class="text-right px-6 py-3 text-slate-400 text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="idea in ideas" :key="idea.id" class="border-b border-slate-800/50">
                        <td class="px-6 py-4">{{ idea.title }}</td>
                        <td class="px-6 py-4 text-slate-400">{{ idea.author?.username || 'Unknown' }}</td>
                        <td class="px-6 py-4 text-slate-400">{{ idea.votes_count }}</td>
                        <td class="px-6 py-4 text-slate-400">{{ idea.comments_count }}</td>
                        <td class="px-6 py-4">
                            <select
                                :value="idea.status"
                                @change="updateStatus(idea, $event.target.value)"
                                class="px-2 py-1 rounded text-xs font-medium bg-surface border border-slate-700 text-white focus:outline-none focus:border-primary"
                            >
                                <option value="new">New</option>
                                <option value="in_progress">In Progress</option>
                                <option value="in_beta_testing">Beta Testing</option>
                                <option value="live">Live</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button @click="deleteIdea(idea)" class="text-red-400 hover:text-red-300 transition">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!ideas.length">
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">No ideas yet.</td>
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
const ideas = ref([]);

async function loadData() {
    const [gameRes, ideasRes] = await Promise.all([
        apiFetch(`/api/admin/games/${gameId}`),
        apiFetch(`/api/admin/games/${gameId}/ideas`),
    ]);
    if (gameRes.ok) {
        const game = await gameRes.json();
        gameName.value = game.name;
    }
    if (ideasRes.ok) ideas.value = await ideasRes.json();
}

async function updateStatus(idea, status) {
    const res = await apiFetch(`/api/admin/ideas/${idea.id}/status`, {
        method: 'PUT',
        body: JSON.stringify({ status }),
    });
    if (res.ok) {
        idea.status = status;
    }
}

async function deleteIdea(idea) {
    if (!confirm(`Delete "${idea.title}"?`)) return;
    const res = await apiFetch(`/api/admin/ideas/${idea.id}`, { method: 'DELETE' });
    if (res.ok) ideas.value = ideas.value.filter(i => i.id !== idea.id);
}

onMounted(loadData);
</script>
