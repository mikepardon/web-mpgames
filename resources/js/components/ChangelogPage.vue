<template>
    <div>
        <!-- Hero -->
        <section class="relative pt-32 pb-16 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-surface to-accent/10"></div>
            <div class="absolute inset-0 bg-grid opacity-20"></div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
                    <router-link to="/" class="hover:text-white transition">Home</router-link>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    <router-link :to="`/games/${slug}`" class="hover:text-white transition">{{ gameName }}</router-link>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    <span class="text-gray-300">Changelog</span>
                </div>
                <h1 class="text-4xl sm:text-5xl font-black text-white mb-4">Changelog</h1>
                <p class="text-lg text-gray-400">See what's new and what's changed in {{ gameName }}.</p>
            </div>
        </section>

        <!-- Timeline -->
        <section class="relative py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div v-if="loading" class="text-center py-20">
                    <div class="w-12 h-12 border-2 border-primary/30 border-t-primary rounded-full animate-spin mx-auto mb-4"></div>
                    <p class="text-gray-500">Loading changelog...</p>
                </div>

                <div v-else-if="!entries.length" class="text-center py-20">
                    <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    </div>
                    <p class="text-gray-500">No changelog entries yet.</p>
                </div>

                <div v-else class="relative">
                    <!-- Timeline line -->
                    <div class="absolute left-[19px] top-2 bottom-2 w-px bg-white/10 hidden sm:block"></div>

                    <div v-for="entry in entries" :key="entry.id" class="relative flex gap-6 mb-8 last:mb-0">
                        <!-- Timeline dot -->
                        <div class="hidden sm:flex shrink-0 w-10 h-10 rounded-full items-center justify-center z-10" :class="categoryDotClass(entry.category)">
                            <svg v-if="entry.category === 'feature'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            <svg v-else-if="entry.category === 'bug_fix'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <svg v-else-if="entry.category === 'improvement'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                            <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" /></svg>
                        </div>

                        <!-- Content -->
                        <div class="glass rounded-xl p-6 flex-1 hover:bg-white/[0.02] transition-all duration-200">
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary/10 text-primary-light border border-primary/20">
                                    v{{ entry.version }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold" :class="categoryBadgeClass(entry.category)">
                                    {{ categoryLabel(entry.category) }}
                                </span>
                                <span class="text-xs text-gray-500 ml-auto">{{ formatDate(entry.published_at) }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2">{{ entry.title }}</h3>
                            <p class="text-gray-400 leading-relaxed whitespace-pre-line">{{ entry.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const slug = ref(route.params.slug);
const gameName = ref('');
const entries = ref([]);
const loading = ref(true);

function categoryDotClass(cat) {
    const map = {
        feature: 'bg-green-500/20 text-green-400 border border-green-500/30',
        bug_fix: 'bg-red-500/20 text-red-400 border border-red-500/30',
        improvement: 'bg-blue-500/20 text-blue-400 border border-blue-500/30',
        balance: 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30',
    };
    return map[cat] || map.improvement;
}

function categoryBadgeClass(cat) {
    const map = {
        feature: 'bg-green-500/10 text-green-400 border border-green-500/20',
        bug_fix: 'bg-red-500/10 text-red-400 border border-red-500/20',
        improvement: 'bg-blue-500/10 text-blue-400 border border-blue-500/20',
        balance: 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20',
    };
    return map[cat] || map.improvement;
}

function categoryLabel(cat) {
    const map = { feature: 'Feature', bug_fix: 'Bug Fix', improvement: 'Improvement', balance: 'Balance' };
    return map[cat] || cat;
}

function formatDate(dateStr) {
    return new Date(dateStr).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
}

async function load() {
    loading.value = true;
    slug.value = route.params.slug;

    const [gameRes, changelogRes] = await Promise.all([
        fetch(`/api/games/${slug.value}`),
        fetch(`/api/games/${slug.value}/changelog`),
    ]);

    if (gameRes.ok) {
        const game = await gameRes.json();
        gameName.value = game.name;
    }
    if (changelogRes.ok) {
        entries.value = await changelogRes.json();
    }

    loading.value = false;
}

onMounted(load);
watch(() => route.params.slug, load);
</script>
