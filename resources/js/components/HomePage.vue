<template>
    <div>
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-24 sm:py-32">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-purple-600/20"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl sm:text-7xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">MPGames</span>
                </h1>
                <p class="text-xl sm:text-2xl text-slate-300 max-w-2xl mx-auto mb-10">
                    Multiplayer games that bring people together. Play with friends, compete with rivals.
                </p>
                <a href="#games" class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-3 rounded-lg transition">
                    Browse Games
                </a>
            </div>
        </section>

        <!-- Games Grid -->
        <section id="games" class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12">Our Games</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <router-link
                        v-for="game in games"
                        :key="game.slug"
                        :to="`/games/${game.slug}`"
                        class="group bg-surface-light border border-slate-800 rounded-xl overflow-hidden hover:border-primary/50 transition-all duration-300 hover:shadow-lg hover:shadow-primary/10"
                    >
                        <div v-if="game.banner_url" class="h-48 bg-cover bg-center" :style="{ backgroundImage: `url(${game.banner_url})` }"></div>
                        <div v-else class="h-48 bg-gradient-to-br from-blue-600/30 to-purple-600/30 flex items-center justify-center">
                            <span class="text-4xl font-bold text-slate-600">{{ game.name[0] }}</span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 group-hover:text-primary transition">{{ game.name }}</h3>
                            <p class="text-slate-400">{{ game.short_description }}</p>
                        </div>
                    </router-link>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="py-16 bg-surface">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-6">About MPGames</h2>
                <p class="text-slate-300 max-w-2xl mx-auto text-lg">
                    MPGames is a platform dedicated to creating engaging multiplayer experiences.
                    Whether you're looking for strategic depth or casual fun, our games are designed
                    to be played with friends and community.
                </p>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const games = ref([]);

onMounted(async () => {
    const res = await fetch('/api/games');
    if (res.ok) games.value = await res.json();
});
</script>
