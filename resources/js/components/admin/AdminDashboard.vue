<template>
    <AdminLayout>
        <h1 class="text-3xl font-bold mb-8">Dashboard</h1>
        <div class="grid sm:grid-cols-3 lg:grid-cols-5 gap-6">
            <div class="bg-surface-light border border-slate-800 rounded-xl p-6">
                <div class="text-3xl font-bold text-primary">{{ stats.games_count }}</div>
                <div class="text-slate-400 mt-1">Total Games</div>
            </div>
            <div class="bg-surface-light border border-slate-800 rounded-xl p-6">
                <div class="text-3xl font-bold text-green-400">{{ stats.published_count }}</div>
                <div class="text-slate-400 mt-1">Published</div>
            </div>
            <div class="bg-surface-light border border-slate-800 rounded-xl p-6">
                <div class="text-3xl font-bold text-purple-400">{{ stats.pages_count }}</div>
                <div class="text-slate-400 mt-1">Pages</div>
            </div>
            <div class="bg-surface-light border border-slate-800 rounded-xl p-6">
                <div class="text-3xl font-bold text-blue-400">{{ stats.changelog_count }}</div>
                <div class="text-slate-400 mt-1">Changelog Entries</div>
            </div>
            <div class="bg-surface-light border border-slate-800 rounded-xl p-6">
                <div class="text-3xl font-bold text-yellow-400">{{ stats.ideas_count }}</div>
                <div class="text-slate-400 mt-1">Ideas</div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AdminLayout from './AdminLayout.vue';
import { apiFetch } from '../../stores/auth.js';

const stats = ref({ games_count: 0, published_count: 0, pages_count: 0, changelog_count: 0, ideas_count: 0 });

onMounted(async () => {
    const res = await apiFetch('/api/admin/dashboard');
    if (res.ok) stats.value = await res.json();
});
</script>
