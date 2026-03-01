<template>
    <div>
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <!-- Animated background -->
            <div class="absolute inset-0 bg-surface">
                <div class="absolute inset-0 bg-grid opacity-50"></div>
                <!-- Gradient orbs -->
                <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-primary/15 rounded-full blur-[120px] animate-float"></div>
                <div class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] bg-accent/15 rounded-full blur-[100px] animate-float-delay"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/5 rounded-full blur-[80px] animate-float-slow"></div>
                <!-- Decorative ring -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] border border-primary/5 rounded-full animate-spin-slow"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-accent/5 rounded-full animate-spin-slow" style="animation-direction: reverse; animation-duration: 30s;"></div>
            </div>

            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24">
                <!-- Headline -->
                <h1 class="animate-fade-up-delay-1 text-5xl sm:text-7xl lg:text-8xl font-black leading-[0.9] tracking-tight mb-8">
                    <span class="block text-white">Games That</span>
                    <span class="block gradient-text text-glow">Break The Mold</span>
                </h1>

                <!-- Subtext -->
                <p class="animate-fade-up-delay-2 text-lg sm:text-xl text-gray-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                    Not another battle royale. Not another match-3. We build
                    <span class="text-white font-medium">multiplayer experiences</span> that
                    surprise, challenge, and bring people together in ways they've never played before.
                </p>

                <!-- CTAs -->
                <div class="animate-fade-up-delay-3 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a
                        href="#games"
                        class="group relative inline-flex items-center gap-2 px-8 py-4 rounded-xl font-bold text-lg bg-primary hover:bg-primary-dark text-white btn-lift animate-pulse-glow"
                    >
                        Explore Our Games
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <router-link
                        v-if="playableGame"
                        :to="`/games/${playableGame.slug}`"
                        class="inline-flex items-center gap-2 px-8 py-4 rounded-xl font-bold text-lg glass text-white hover:bg-white/10 transition-all duration-300"
                    >
                        <svg class="w-5 h-5 text-accent" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                        Play Instantly
                    </router-link>
                </div>

                <!-- Scroll indicator -->
                <div class="mt-20 animate-bounce">
                    <svg class="w-6 h-6 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </div>
        </section>

        <!-- Games Showcase -->
        <section id="games" class="relative py-24 sm:py-32">
            <div class="absolute inset-0 bg-gradient-to-b from-surface via-surface-light/50 to-surface"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section header -->
                <div class="text-center mb-16">
                    <h2 class="text-sm font-semibold text-accent uppercase tracking-widest mb-4">The Collection</h2>
                    <p class="text-4xl sm:text-5xl font-bold text-white">
                        Pick Your Next <span class="gradient-text">Obsession</span>
                    </p>
                </div>

                <!-- Game Cards -->
                <div class="grid lg:grid-cols-2 gap-8">
                    <router-link
                        v-for="(game, index) in games"
                        :key="game.slug"
                        :to="`/games/${game.slug}`"
                        class="group relative card-shine rounded-2xl overflow-hidden transition-all duration-500 hover:scale-[1.02]"
                    >
                        <!-- Card background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-surface-light to-surface-lighter opacity-80"></div>
                        <div :class="[
                            'absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500',
                            index % 2 === 0 ? 'bg-gradient-to-br from-primary/10 to-accent/5' : 'bg-gradient-to-br from-accent/10 to-primary/5'
                        ]"></div>

                        <div class="relative p-1">
                            <!-- Banner -->
                            <div class="relative">
                                <div v-if="game.banner_url"
                                    class="h-52 sm:h-64 rounded-xl bg-cover bg-center transition-transform duration-700 group-hover:scale-[1.03]"
                                    :style="{ backgroundImage: `url(${game.banner_url})` }"
                                >
                                    <div class="absolute inset-0 bg-gradient-to-t from-surface-light/90 via-transparent to-transparent rounded-xl"></div>
                                </div>
                                <div v-else class="h-52 sm:h-64 rounded-xl bg-gradient-to-br from-primary/20 via-surface-light to-accent/20 flex items-center justify-center transition-transform duration-700 group-hover:scale-[1.03]">
                                    <span class="text-7xl font-black text-white/10">{{ game.name.substring(0, 2).toUpperCase() }}</span>
                                </div>

                                <!-- Badges -->
                                <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                    <span v-if="game.coming_soon" class="px-3 py-1 rounded-full text-xs font-bold bg-hot/90 text-white backdrop-blur-sm">
                                        Coming Soon
                                    </span>
                                    <span v-if="!game.coming_soon && game.play_url" class="px-3 py-1 rounded-full text-xs font-bold bg-green-500/90 text-white backdrop-blur-sm">
                                        Play Now
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 sm:p-8">
                                <div class="flex items-start justify-between gap-4 mb-4">
                                    <div>
                                        <h3 class="text-2xl sm:text-3xl font-bold text-white group-hover:text-primary-light transition-colors duration-300">
                                            {{ game.name }}
                                        </h3>
                                        <p class="text-gray-400 mt-2 text-base leading-relaxed">{{ game.short_description }}</p>
                                    </div>
                                    <div class="shrink-0 w-12 h-12 rounded-xl bg-primary/10 border border-primary/20 flex items-center justify-center group-hover:bg-primary/20 group-hover:border-primary/40 transition-all duration-300">
                                        <svg class="w-5 h-5 text-primary-light transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Features pills -->
                                <div v-if="game.features && game.features.length" class="flex flex-wrap gap-2">
                                    <span
                                        v-for="feature in game.features.slice(0, 3)"
                                        :key="feature"
                                        class="px-3 py-1 rounded-full text-xs font-medium bg-white/5 text-gray-400 border border-white/5"
                                    >
                                        {{ feature }}
                                    </span>
                                    <span
                                        v-if="game.features.length > 3"
                                        class="px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary-light border border-primary/20"
                                    >
                                        +{{ game.features.length - 3 }} more
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Border glow on hover -->
                        <div class="absolute inset-0 rounded-2xl border border-white/5 group-hover:border-primary/30 transition-colors duration-500 pointer-events-none"></div>
                    </router-link>
                </div>
            </div>
        </section>

        <!-- Why MPGames -->
        <section class="relative py-24 sm:py-32 overflow-hidden">
            <div class="absolute inset-0 bg-surface"></div>
            <!-- Background accent -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-accent/5 rounded-full blur-[150px]"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[150px]"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-sm font-semibold text-accent uppercase tracking-widest mb-4">Why MPGames</h2>
                    <p class="text-4xl sm:text-5xl font-bold text-white">
                        Built Different, <span class="gradient-text">Played Together</span>
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Feature 1 -->
                    <div class="group glass rounded-2xl p-8 hover:bg-white/[0.04] transition-all duration-300">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary/20 to-primary/5 border border-primary/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Original Concepts</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Every game is an original idea you won't find anywhere else. No clones, no copies -- just fresh mechanics that make you think.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group glass rounded-2xl p-8 hover:bg-white/[0.04] transition-all duration-300">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-accent/20 to-accent/5 border border-accent/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-accent-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Multiplayer First</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Designed from the ground up for real human interaction. Bluff, strategize, and outsmart real people -- not bots.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group glass rounded-2xl p-8 hover:bg-white/[0.04] transition-all duration-300">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-hot/20 to-hot/5 border border-hot/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-hot" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Instant Play</h3>
                        <p class="text-gray-400 leading-relaxed">
                            No downloads. No installs. Create an account in seconds and jump straight into the action with your friends.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="group glass rounded-2xl p-8 hover:bg-white/[0.04] transition-all duration-300">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-green-500/20 to-green-500/5 border border-green-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Play Anywhere</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Desktop, tablet, or phone. Our games work beautifully on any device, so you can play wherever you are.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="group glass rounded-2xl p-8 hover:bg-white/[0.04] transition-all duration-300">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-500/5 border border-purple-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Free to Play</h3>
                        <p class="text-gray-400 leading-relaxed">
                            All our games are free to play. Optional add-ons are available, but the full core experience costs nothing.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="group glass rounded-2xl p-8 hover:bg-white/[0.04] transition-all duration-300">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-rose-500/20 to-rose-500/5 border border-rose-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Always Evolving</h3>
                        <p class="text-gray-400 leading-relaxed">
                            We actively develop and improve our games based on player feedback. New features, modes, and surprises regularly.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative py-24 sm:py-32 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-surface to-accent/10"></div>
            <div class="absolute inset-0 bg-grid opacity-30"></div>
            <!-- Glow -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-primary/10 rounded-full blur-[100px]"></div>

            <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl sm:text-6xl font-black text-white mb-6">
                    Ready to Play Something <span class="gradient-text">Different</span>?
                </h2>
                <p class="text-lg text-gray-400 mb-10 max-w-xl mx-auto">
                    Jump in right now. Quick sign-up, no downloads, no waiting. Just you, your friends, and a game you've never seen before.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <router-link
                        v-if="playableGame"
                        :to="`/games/${playableGame.slug}`"
                        class="group inline-flex items-center gap-3 px-10 py-5 rounded-2xl font-bold text-lg bg-white text-surface hover:bg-gray-100 transition-all duration-300 btn-lift shadow-xl shadow-white/10"
                    >
                        <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                        Start Playing
                    </router-link>
                    <a
                        href="#games"
                        class="inline-flex items-center gap-2 px-8 py-5 rounded-2xl font-semibold text-lg text-gray-300 hover:text-white glass hover:bg-white/10 transition-all duration-300"
                    >
                        Browse Games
                    </a>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const games = ref([]);

const playableGame = computed(() => games.value.find(g => !g.coming_soon));

onMounted(async () => {
    const res = await fetch('/api/games');
    if (res.ok) games.value = await res.json();
});
</script>