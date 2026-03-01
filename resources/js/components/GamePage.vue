<template>
    <div v-if="game" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Banner -->
        <div v-if="game.banner_url" class="h-64 rounded-xl bg-cover bg-center mb-8" :style="{ backgroundImage: `url(${game.banner_url})` }"></div>
        <div v-else class="h-64 rounded-xl bg-gradient-to-br from-blue-600/30 to-purple-600/30 flex items-center justify-center mb-8">
            <span class="text-6xl font-bold text-slate-600">{{ game.name[0] }}</span>
        </div>

        <h1 class="text-4xl font-bold mb-4">{{ game.name }}</h1>
        <p class="text-lg text-slate-300 mb-8">{{ game.short_description }}</p>

        <div class="prose prose-invert max-w-none mb-8">
            <p class="text-slate-300 whitespace-pre-line">{{ game.description }}</p>
        </div>

        <!-- Features -->
        <div v-if="game.features && game.features.length" class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Features</h2>
            <ul class="space-y-2">
                <li v-for="(feature, i) in game.features" :key="i" class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-primary mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-slate-300">{{ feature }}</span>
                </li>
            </ul>
        </div>

        <!-- Play Button -->
        <a
            :href="game.play_url"
            target="_blank"
            class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-3 rounded-lg transition text-lg"
        >
            Play Now
        </a>
    </div>
    <div v-else class="max-w-4xl mx-auto px-4 py-12 text-center text-slate-400">
        Loading...
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const game = ref(null);

async function loadGame() {
    const res = await fetch(`/api/games/${route.params.slug}`);
    if (res.ok) game.value = await res.json();
}

onMounted(loadGame);
watch(() => route.params.slug, loadGame);
</script>
