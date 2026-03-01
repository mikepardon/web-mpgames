<template>
    <div v-if="game">
        <!-- Hero Banner -->
        <section class="relative min-h-[70vh] flex items-end overflow-hidden">
            <!-- Background -->
            <div v-if="game.banner_url"
                class="absolute inset-0 bg-cover bg-center scale-105"
                :style="{ backgroundImage: `url(${game.banner_url})` }"
            ></div>
            <div v-else class="absolute inset-0 bg-gradient-to-br from-primary/20 via-surface to-accent/20">
                <div class="absolute inset-0 bg-grid opacity-40"></div>
                <div class="absolute top-1/3 left-1/4 w-[400px] h-[400px] bg-primary/15 rounded-full blur-[120px] animate-float"></div>
                <div class="absolute bottom-1/3 right-1/4 w-[300px] h-[300px] bg-accent/15 rounded-full blur-[100px] animate-float-delay"></div>
            </div>

            <!-- Gradient overlays -->
            <div class="absolute inset-0 bg-gradient-to-t from-surface via-surface/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-surface/50 to-transparent"></div>

            <!-- Content -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 pt-48 w-full">
                <div class="max-w-3xl">
                    <!-- Breadcrumb -->
                    <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
                        <router-link to="/" class="hover:text-white transition">Home</router-link>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-gray-300">{{ game.name }}</span>
                    </div>

                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span v-if="game.coming_soon" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-bold bg-hot/90 text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Coming Soon
                        </span>
                    </div>

                    <h1 class="text-5xl sm:text-7xl font-black text-white mb-6 tracking-tight leading-[0.95]">
                        {{ game.name }}
                    </h1>

                    <p class="text-xl text-gray-300 mb-10 max-w-2xl leading-relaxed">
                        {{ game.short_description }}
                    </p>

                    <!-- Action buttons -->
                    <div class="flex flex-wrap items-center gap-4">
                        <template v-if="!game.coming_soon">
                            <a
                                :href="game.play_url"
                                target="_blank"
                                class="group inline-flex items-center gap-3 px-10 py-5 rounded-2xl font-bold text-lg bg-primary hover:bg-primary-dark text-white btn-lift animate-pulse-glow"
                            >
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                                Play Now -- It's Free
                            </a>
                            <div class="flex items-center gap-3 text-sm text-gray-400">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                                    Online now
                                </div>
                                <span class="text-gray-700">|</span>
                                <span>No download required</span>
                            </div>
                        </template>
                        <template v-else>
                            <div class="inline-flex items-center gap-3 px-10 py-5 rounded-2xl font-bold text-lg bg-surface-lighter/80 text-gray-400 border border-white/10 cursor-default">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Coming Soon
                            </div>
                            <span class="text-sm text-gray-500">We're working hard to bring this to you</span>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mobile App Announcement (for Trusted Advisors) -->
        <section v-if="!game.coming_soon && game.slug === 'trusted-advisors'" class="relative py-12 border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="glass rounded-2xl p-8 sm:p-10 flex flex-col sm:flex-row items-center gap-6 sm:gap-10">
                    <div class="shrink-0 w-16 h-16 rounded-2xl bg-gradient-to-br from-primary/20 to-accent/20 border border-primary/20 flex items-center justify-center">
                        <svg class="w-8 h-8 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="text-center sm:text-left">
                        <div class="flex items-center justify-center sm:justify-start gap-2 mb-2">
                            <h3 class="text-xl font-bold text-white">Coming to iOS & Google Play</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-hot/90 text-white">Soon</span>
                        </div>
                        <p class="text-gray-400">
                            Trusted Advisors is coming to mobile. Play on the go with native apps for iPhone, iPad, and Android devices.
                        </p>
                    </div>
                    <div class="shrink-0 flex items-center gap-3">
                        <!-- App Store badge -->
                        <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                            <svg class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                            </svg>
                            <span class="text-[10px] text-gray-500 font-medium">App Store</span>
                        </div>
                        <!-- Google Play badge -->
                        <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                            <svg class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3.609 1.814L13.792 12 3.609 22.186a.996.996 0 01-.609-.92V2.734a.996.996 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.199l2.302 2.302-2.302 2.302L15.396 12l2.302-2.302v-.19zM5.864 2.658L16.801 8.99l-2.302 2.302L5.864 2.658z"/>
                            </svg>
                            <span class="text-[10px] text-gray-500 font-medium">Google Play</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Game Details -->
        <section class="relative py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-12">
                        <!-- About -->
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <div class="w-1 h-7 bg-primary rounded-full"></div>
                                About This Game
                            </h2>
                            <div class="text-gray-300 text-lg leading-relaxed whitespace-pre-line">{{ game.description }}</div>
                        </div>

                        <!-- Features Grid -->
                        <div v-if="game.features && game.features.length">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <div class="w-1 h-7 bg-accent rounded-full"></div>
                                What Makes It Special
                            </h2>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div
                                    v-for="(feature, i) in game.features"
                                    :key="i"
                                    class="group glass rounded-xl p-5 hover:bg-white/[0.04] transition-all duration-300"
                                >
                                    <div class="flex items-start gap-4">
                                        <div class="shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-primary/20 to-accent/10 border border-primary/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span class="text-gray-200 font-medium pt-2">{{ feature }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Play Card -->
                        <div class="glass rounded-2xl p-8 sticky top-24">
                            <div class="text-center mb-6">
                                <template v-if="!game.coming_soon">
                                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-green-500/10 text-green-400 text-sm font-medium border border-green-500/20 mb-4">
                                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                                        Free to Play
                                    </div>
                                    <h3 class="text-xl font-bold text-white">Jump In Right Now</h3>
                                    <p class="text-gray-400 text-sm mt-2">Free to play with optional add-ons</p>
                                </template>
                                <template v-else>
                                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-hot/10 text-hot text-sm font-medium border border-hot/20 mb-4">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Coming Soon
                                    </div>
                                    <h3 class="text-xl font-bold text-white">In Development</h3>
                                    <p class="text-gray-400 text-sm mt-2">This game is being built and will be available soon</p>
                                </template>
                            </div>

                            <template v-if="!game.coming_soon">
                                <a
                                    :href="game.play_url"
                                    target="_blank"
                                    class="block w-full py-4 rounded-xl font-bold text-center bg-primary hover:bg-primary-dark text-white btn-lift text-lg transition-all duration-300"
                                >
                                    Play {{ game.name }}
                                </a>
                            </template>
                            <template v-else>
                                <div class="w-full py-4 rounded-xl font-bold text-center bg-surface-lighter text-gray-500 border border-white/5 text-lg cursor-default">
                                    Not Yet Available
                                </div>
                            </template>

                            <div class="mt-6 space-y-3">
                                <div class="flex items-center gap-3 text-sm text-gray-400">
                                    <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                                    </svg>
                                    <span>Browser-based, works everywhere</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-gray-400">
                                    <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Multiplayer with friends</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-gray-400">
                                    <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <span>Mobile & desktop friendly</span>
                                </div>
                            </div>
                        </div>

                        <!-- Share Card -->
                        <div v-if="!game.coming_soon" class="glass rounded-2xl p-6">
                            <h4 class="font-semibold text-white mb-3">Share with friends</h4>
                            <p class="text-sm text-gray-400 mb-4">The more players, the more fun. Send this to your group chat.</p>
                            <button
                                @click="copyLink"
                                class="w-full py-3 rounded-xl text-sm font-medium bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white border border-white/5 hover:border-white/10 transition-all duration-200 flex items-center justify-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                                {{ copied ? 'Link Copied!' : 'Copy Game Link' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Other Games -->
        <section v-if="otherGames.length" class="relative py-20 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-white mb-10">More Games to Try</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <router-link
                        v-for="other in otherGames"
                        :key="other.slug"
                        :to="`/games/${other.slug}`"
                        class="group card-shine glass rounded-2xl overflow-hidden hover:bg-white/[0.04] transition-all duration-300"
                    >
                        <div class="relative">
                            <div v-if="other.banner_url"
                                class="h-40 bg-cover bg-center"
                                :style="{ backgroundImage: `url(${other.banner_url})` }"
                            ></div>
                            <div v-else class="h-40 bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center">
                                <span class="text-4xl font-black text-white/10">{{ other.name.substring(0, 2).toUpperCase() }}</span>
                            </div>
                            <span v-if="other.coming_soon" class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-bold bg-hot/90 text-white">
                                Coming Soon
                            </span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-white group-hover:text-primary-light transition-colors">{{ other.name }}</h3>
                            <p class="text-sm text-gray-400 mt-2 line-clamp-2">{{ other.short_description }}</p>
                        </div>
                    </router-link>
                </div>
            </div>
        </section>
    </div>

    <!-- Loading State -->
    <div v-else class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <div class="w-12 h-12 border-2 border-primary/30 border-t-primary rounded-full animate-spin mx-auto mb-4"></div>
            <p class="text-gray-500">Loading game...</p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const game = ref(null);
const allGames = ref([]);
const copied = ref(false);

const otherGames = computed(() => {
    if (!game.value) return [];
    return allGames.value.filter(g => g.slug !== game.value.slug);
});

async function loadGame() {
    game.value = null;
    const res = await fetch(`/api/games/${route.params.slug}`);
    if (res.ok) game.value = await res.json();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

async function loadAllGames() {
    const res = await fetch('/api/games');
    if (res.ok) allGames.value = await res.json();
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href);
    copied.value = true;
    setTimeout(() => { copied.value = false; }, 2000);
}

onMounted(() => {
    loadGame();
    loadAllGames();
});
watch(() => route.params.slug, loadGame);
</script>