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
                        <span v-if="game.modes && game.modes.length" v-for="mode in game.modes" :key="mode.name" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-gray-300 border border-white/10">
                            {{ mode.name }}
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
                        <div class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                            <svg class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                            </svg>
                            <span class="text-[10px] text-gray-500 font-medium">App Store</span>
                        </div>
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
        <section class="relative py-20 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-16">
                        <!-- About -->
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <div class="w-1 h-7 bg-primary rounded-full"></div>
                                About This Game
                            </h2>
                            <div class="text-gray-300 text-lg leading-relaxed whitespace-pre-line">{{ game.description }}</div>
                        </div>

                        <!-- Extended Description -->
                        <div v-if="game.long_description">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <div class="w-1 h-7 bg-accent rounded-full"></div>
                                How It Plays
                            </h2>
                            <div class="text-gray-400 text-base leading-relaxed whitespace-pre-line">{{ game.long_description }}</div>
                        </div>

                        <!-- Features Grid -->
                        <div v-if="game.features && game.features.length">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <div class="w-1 h-7 bg-green-500 rounded-full"></div>
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

                        <!-- Game Modes -->
                        <div v-if="game.modes && game.modes.length">
                            <h2 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
                                <div class="w-1 h-7 bg-hot rounded-full"></div>
                                Game Modes
                            </h2>
                            <div class="space-y-6">
                                <div
                                    v-for="(mode, i) in game.modes"
                                    :key="mode.name"
                                    class="group glass rounded-2xl overflow-hidden hover:bg-white/[0.02] transition-all duration-300"
                                >
                                    <!-- Mode header -->
                                    <div class="p-6 sm:p-8">
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-4">
                                            <div :class="[
                                                'shrink-0 w-12 h-12 rounded-xl flex items-center justify-center',
                                                i === 0 ? 'bg-gradient-to-br from-accent/20 to-accent/5 border border-accent/20' : 'bg-gradient-to-br from-hot/20 to-hot/5 border border-hot/20'
                                            ]">
                                                <!-- Co-op icon -->
                                                <svg v-if="mode.name.toLowerCase().includes('co-op') || mode.name.toLowerCase().includes('coop')" :class="['w-6 h-6', i === 0 ? 'text-accent-light' : 'text-hot']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <!-- Duel icon -->
                                                <svg v-else-if="mode.name.toLowerCase().includes('duel')" :class="['w-6 h-6', i === 0 ? 'text-accent-light' : 'text-hot']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                                <!-- Generic mode icon -->
                                                <svg v-else :class="['w-6 h-6', i === 0 ? 'text-accent-light' : 'text-hot']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-3">
                                                    <h3 class="text-xl font-bold text-white">{{ mode.name }}</h3>
                                                    <span v-if="mode.tag" :class="[
                                                        'px-2.5 py-0.5 rounded-full text-xs font-bold',
                                                        i === 0 ? 'bg-accent/10 text-accent-light border border-accent/20' : 'bg-hot/10 text-hot border border-hot/20'
                                                    ]">{{ mode.tag }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-400 leading-relaxed mb-6">{{ mode.description }}</p>

                                        <!-- Mode highlights -->
                                        <div v-if="mode.highlights && mode.highlights.length" class="grid sm:grid-cols-2 gap-3">
                                            <div
                                                v-for="(highlight, j) in mode.highlights"
                                                :key="j"
                                                class="flex items-start gap-3"
                                            >
                                                <svg :class="['w-4 h-4 mt-0.5 shrink-0', i === 0 ? 'text-accent' : 'text-hot']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="text-sm text-gray-300">{{ highlight }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Section -->
                        <div v-if="game.faq && game.faq.length">
                            <h2 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
                                <div class="w-1 h-7 bg-purple-500 rounded-full"></div>
                                Frequently Asked Questions
                            </h2>
                            <div class="space-y-4">
                                <div
                                    v-for="(item, i) in game.faq"
                                    :key="i"
                                    class="glass rounded-xl overflow-hidden"
                                >
                                    <button
                                        @click="toggleFaq(i)"
                                        class="w-full flex items-center justify-between gap-4 p-5 sm:p-6 text-left hover:bg-white/[0.02] transition-colors duration-200"
                                    >
                                        <span class="font-semibold text-white text-base">{{ item.question }}</span>
                                        <svg
                                            :class="['w-5 h-5 text-gray-500 shrink-0 transition-transform duration-300', openFaqs.has(i) ? 'rotate-180' : '']"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div
                                        v-if="openFaqs.has(i)"
                                        class="px-5 sm:px-6 pb-5 sm:pb-6"
                                    >
                                        <div class="section-divider mb-4"></div>
                                        <p class="text-gray-400 leading-relaxed">{{ item.answer }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                        <!-- Play Card -->
                        <div class="glass rounded-2xl p-8">
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
                                <!-- Game modes summary -->
                                <div v-if="game.modes && game.modes.length" class="flex items-center gap-3 text-sm text-gray-400">
                                    <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    <span>{{ game.modes.length }} game mode{{ game.modes.length > 1 ? 's' : '' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Community Card -->
                        <div class="glass rounded-2xl p-6">
                            <h4 class="font-semibold text-white mb-3">Community</h4>
                            <p class="text-sm text-gray-400 mb-4">Stay up to date and help shape the game.</p>
                            <div class="space-y-2">
                                <router-link
                                    :to="`/games/${game.slug}/changelog`"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white transition-all duration-200 group"
                                >
                                    <svg class="w-5 h-5 text-primary-light shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <div>
                                        <div class="text-sm font-medium">Changelog</div>
                                        <div class="text-xs text-gray-500">See what's new</div>
                                    </div>
                                    <svg class="w-4 h-4 ml-auto text-gray-600 group-hover:text-gray-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </router-link>
                                <router-link
                                    :to="`/games/${game.slug}/ideas`"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white transition-all duration-200 group"
                                >
                                    <svg class="w-5 h-5 text-accent-light shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                    <div>
                                        <div class="text-sm font-medium">Ideas Board</div>
                                        <div class="text-xs text-gray-500">Vote & suggest features</div>
                                    </div>
                                    <svg class="w-4 h-4 ml-auto text-gray-600 group-hover:text-gray-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </router-link>
                            </div>
                        </div>

                        <!-- Share Card -->
                        <div class="glass rounded-2xl p-6">
                            <h4 class="font-semibold text-white mb-3">Share with friends</h4>
                            <p class="text-sm text-gray-400 mb-4">The more players, the more fun. Spread the word.</p>

                            <!-- Social share buttons -->
                            <div class="grid grid-cols-2 gap-2 mb-3">
                                <a
                                    :href="shareUrls.twitter"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-medium bg-white/5 hover:bg-[#1DA1F2]/10 text-gray-400 hover:text-[#1DA1F2] border border-white/5 hover:border-[#1DA1F2]/30 transition-all duration-200"
                                >
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                    X / Twitter
                                </a>
                                <a
                                    :href="shareUrls.facebook"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-medium bg-white/5 hover:bg-[#1877F2]/10 text-gray-400 hover:text-[#1877F2] border border-white/5 hover:border-[#1877F2]/30 transition-all duration-200"
                                >
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    Facebook
                                </a>
                                <a
                                    :href="shareUrls.reddit"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-medium bg-white/5 hover:bg-[#FF4500]/10 text-gray-400 hover:text-[#FF4500] border border-white/5 hover:border-[#FF4500]/30 transition-all duration-200"
                                >
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0zm5.01 4.744c.688 0 1.25.561 1.25 1.249a1.25 1.25 0 0 1-2.498.056l-2.597-.547-.8 3.747c1.824.07 3.48.632 4.674 1.488.308-.309.73-.491 1.207-.491.968 0 1.754.786 1.754 1.754 0 .716-.435 1.333-1.01 1.614a3.111 3.111 0 0 1 .042.52c0 2.694-3.13 4.87-7.004 4.87-3.874 0-7.004-2.176-7.004-4.87 0-.183.015-.366.043-.534A1.748 1.748 0 0 1 4.028 12c0-.968.786-1.754 1.754-1.754.463 0 .898.196 1.207.49 1.207-.883 2.878-1.43 4.744-1.487l.885-4.182a.342.342 0 0 1 .14-.197.35.35 0 0 1 .238-.042l2.906.617a1.214 1.214 0 0 1 1.108-.701zM9.25 12C8.561 12 8 12.562 8 13.25c0 .687.561 1.248 1.25 1.248.687 0 1.248-.561 1.248-1.249 0-.688-.561-1.249-1.249-1.249zm5.5 0c-.687 0-1.248.561-1.248 1.25 0 .687.561 1.248 1.249 1.248.688 0 1.249-.561 1.249-1.249 0-.687-.562-1.249-1.25-1.249zm-5.466 3.99a.327.327 0 0 0-.231.094.33.33 0 0 0 0 .463c.842.842 2.484.913 2.961.913.477 0 2.105-.056 2.961-.913a.361.361 0 0 0 .029-.463.33.33 0 0 0-.464 0c-.547.533-1.684.73-2.512.73-.828 0-1.979-.196-2.512-.73a.326.326 0 0 0-.232-.095z"/>
                                    </svg>
                                    Reddit
                                </a>
                                <a
                                    :href="shareUrls.whatsapp"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-medium bg-white/5 hover:bg-[#25D366]/10 text-gray-400 hover:text-[#25D366] border border-white/5 hover:border-[#25D366]/30 transition-all duration-200"
                                >
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    WhatsApp
                                </a>
                            </div>

                            <!-- Copy link -->
                            <button
                                @click="copyLink"
                                class="w-full py-3 rounded-xl text-sm font-medium bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white border border-white/5 hover:border-white/10 transition-all duration-200 flex items-center justify-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                                {{ copied ? 'Link Copied!' : 'Copy Link' }}
                            </button>
                        </div>

                        <!-- Quick Facts Card -->
                        <div class="glass rounded-2xl p-6">
                            <h4 class="font-semibold text-white mb-4">Quick Facts</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-500">Genre</span>
                                    <span class="text-gray-300">Strategy / Social Deduction</span>
                                </div>
                                <div class="section-divider"></div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-500">Players</span>
                                    <span class="text-gray-300">2-6</span>
                                </div>
                                <div class="section-divider"></div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-500">Game Length</span>
                                    <span class="text-gray-300">10-60 min</span>
                                </div>
                                <div class="section-divider"></div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-500">Platform</span>
                                    <span class="text-gray-300">Browser / Mobile</span>
                                </div>
                                <div class="section-divider"></div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-500">Price</span>
                                    <span class="text-green-400 font-medium">Free</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bottom CTA -->
        <section v-if="!game.coming_soon" class="relative py-20 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-surface to-accent/10"></div>
            <div class="absolute inset-0 bg-grid opacity-20"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[250px] bg-primary/10 rounded-full blur-[100px]"></div>

            <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl sm:text-5xl font-black text-white mb-6">
                    Convinced? <span class="gradient-text">Go Play.</span>
                </h2>
                <p class="text-lg text-gray-400 mb-8 max-w-xl mx-auto">
                    {{ game.name }} is free, runs in your browser, and your friends are probably waiting. What are you still doing here?
                </p>
                <a
                    :href="game.play_url"
                    target="_blank"
                    class="group inline-flex items-center gap-3 px-10 py-5 rounded-2xl font-bold text-lg bg-white text-surface hover:bg-gray-100 transition-all duration-300 btn-lift shadow-xl shadow-white/10"
                >
                    <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z" />
                    </svg>
                    Play {{ game.name }} Now
                </a>
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
import { ref, reactive, computed, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const game = ref(null);
const allGames = ref([]);
const copied = ref(false);
const openFaqs = reactive(new Set());

const otherGames = computed(() => {
    if (!game.value) return [];
    return allGames.value.filter(g => g.slug !== game.value.slug);
});

const shareUrls = computed(() => {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(game.value ? `Check out ${game.value.name} on MPGames` : 'Check out MPGames');
    const text = encodeURIComponent(game.value ? `${game.value.name} - ${game.value.short_description}` : '');
    return {
        twitter: `https://twitter.com/intent/tweet?url=${url}&text=${text}`,
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
        reddit: `https://reddit.com/submit?url=${url}&title=${title}`,
        whatsapp: `https://wa.me/?text=${title}%20${url}`,
    };
});

function toggleFaq(index) {
    if (openFaqs.has(index)) {
        openFaqs.delete(index);
    } else {
        openFaqs.add(index);
    }
}

async function loadGame() {
    game.value = null;
    openFaqs.clear();
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
