<template>
    <header class="bg-surface border-b border-slate-800">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <router-link to="/" class="text-2xl font-bold text-primary">
                MPGames
            </router-link>
            <div class="flex items-center gap-6">
                <div class="relative" ref="dropdownRef">
                    <button
                        @click="gamesOpen = !gamesOpen"
                        class="text-slate-300 hover:text-white transition"
                    >
                        Games
                        <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        v-if="gamesOpen"
                        class="absolute top-full mt-2 right-0 bg-surface-light border border-slate-700 rounded-lg shadow-xl py-2 min-w-48 z-50"
                    >
                        <router-link
                            v-for="game in games"
                            :key="game.slug"
                            :to="`/games/${game.slug}`"
                            class="block px-4 py-2 text-slate-300 hover:text-white hover:bg-surface-lighter transition"
                            @click="gamesOpen = false"
                        >
                            {{ game.name }}
                        </router-link>
                    </div>
                </div>
                <router-link to="/privacy-policy" class="text-slate-300 hover:text-white transition">Privacy</router-link>
                <router-link to="/terms" class="text-slate-300 hover:text-white transition">Terms</router-link>
                <router-link to="/contact" class="text-slate-300 hover:text-white transition">Contact</router-link>
            </div>
        </nav>
    </header>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const games = ref([]);
const gamesOpen = ref(false);
const dropdownRef = ref(null);

onMounted(async () => {
    const res = await fetch('/api/games');
    if (res.ok) games.value = await res.json();

    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});

function handleClickOutside(e) {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        gamesOpen.value = false;
    }
}
</script>
