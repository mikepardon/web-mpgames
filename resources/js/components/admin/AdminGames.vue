<template>
    <AdminLayout>
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Games</h1>
            <router-link
                to="/admin/games/new"
                class="bg-primary hover:bg-primary-dark text-white font-semibold px-4 py-2 rounded-lg transition"
            >
                Add Game
            </router-link>
        </div>
        <div class="bg-surface-light border border-slate-800 rounded-xl overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-800">
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Name</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Status</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Order</th>
                        <th class="text-right px-6 py-3 text-slate-400 text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="game in games" :key="game.id" class="border-b border-slate-800/50">
                        <td class="px-6 py-4">{{ game.name }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded text-xs font-medium"
                                :class="game.status === 'published' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400'"
                            >
                                {{ game.status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-400">{{ game.sort_order }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <router-link :to="`/admin/games/${game.id}/edit`" class="text-primary hover:text-primary-light transition">Edit</router-link>
                            <button @click="deleteGame(game)" class="text-red-400 hover:text-red-300 transition">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AdminLayout from './AdminLayout.vue';
import { apiFetch } from '../../stores/auth.js';

const games = ref([]);

async function loadGames() {
    const res = await apiFetch('/api/admin/games');
    if (res.ok) games.value = await res.json();
}

async function deleteGame(game) {
    if (!confirm(`Delete "${game.name}"?`)) return;
    const res = await apiFetch(`/api/admin/games/${game.id}`, { method: 'DELETE' });
    if (res.ok) games.value = games.value.filter(g => g.id !== game.id);
}

onMounted(loadGames);
</script>
