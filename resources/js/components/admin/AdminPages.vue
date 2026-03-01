<template>
    <AdminLayout>
        <h1 class="text-3xl font-bold mb-8">Pages</h1>
        <div class="bg-surface-light border border-slate-800 rounded-xl overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-800">
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Title</th>
                        <th class="text-left px-6 py-3 text-slate-400 text-sm font-medium">Slug</th>
                        <th class="text-right px-6 py-3 text-slate-400 text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="page in pages" :key="page.id" class="border-b border-slate-800/50">
                        <td class="px-6 py-4">{{ page.title }}</td>
                        <td class="px-6 py-4 text-slate-400">{{ page.slug }}</td>
                        <td class="px-6 py-4 text-right">
                            <router-link :to="`/admin/pages/${page.id}/edit`" class="text-primary hover:text-primary-light transition">Edit</router-link>
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

const pages = ref([]);

onMounted(async () => {
    const res = await apiFetch('/api/admin/pages');
    if (res.ok) pages.value = await res.json();
});
</script>
