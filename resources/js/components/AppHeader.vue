<template>
    <header
        :class="[
            'fixed top-0 left-0 right-0 z-50 transition-all duration-500',
            scrolled ? 'glass shadow-lg shadow-black/20' : 'bg-transparent'
        ]"
    >
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between">
            <!-- Logo -->
            <router-link to="/" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary to-accent flex items-center justify-center font-black text-sm tracking-tight transition-transform duration-300 group-hover:scale-110">
                    MP
                </div>
                <span class="text-xl font-bold tracking-tight">
                    <span class="text-white">MP</span><span class="text-primary-light">Games</span>
                </span>
            </router-link>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-1">
                <!-- Games Dropdown -->
                <div class="relative" ref="dropdownRef">
                    <button
                        @click="gamesOpen = !gamesOpen"
                        :class="[
                            'flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200',
                            gamesOpen ? 'text-white bg-white/10' : 'text-gray-300 hover:text-white hover:bg-white/5'
                        ]"
                    >
                        Games
                        <svg
                            :class="['w-4 h-4 transition-transform duration-200', gamesOpen ? 'rotate-180' : '']"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <Transition
                        enter-active-class="transition duration-200 ease-out"
                        enter-from-class="opacity-0 -translate-y-2 scale-95"
                        enter-to-class="opacity-100 translate-y-0 scale-100"
                        leave-active-class="transition duration-150 ease-in"
                        leave-from-class="opacity-100 translate-y-0 scale-100"
                        leave-to-class="opacity-0 -translate-y-2 scale-95"
                    >
                        <div
                            v-if="gamesOpen"
                            class="absolute top-full mt-3 left-1/2 -translate-x-1/2 glass rounded-xl shadow-2xl shadow-black/40 py-2 min-w-56 z-50"
                        >
                            <router-link
                                v-for="game in games"
                                :key="game.slug"
                                :to="`/games/${game.slug}`"
                                class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200"
                                @click="gamesOpen = false"
                            >
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary/30 to-accent/30 flex items-center justify-center text-xs font-bold text-primary-light shrink-0">
                                    {{ game.name.substring(0, 2).toUpperCase() }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium">{{ game.name }}</div>
                                    <div class="text-xs text-gray-500 line-clamp-1">{{ game.short_description }}</div>
                                </div>
                            </router-link>
                        </div>
                    </Transition>
                </div>

                <router-link
                    to="/contact"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200"
                >
                    Contact
                </router-link>

                <!-- CTA -->
                <router-link
                    v-if="games.length"
                    :to="`/games/${games[0].slug}`"
                    class="ml-3 px-5 py-2 rounded-lg text-sm font-semibold bg-primary hover:bg-primary-dark text-white btn-lift"
                >
                    Play Now
                </router-link>
            </div>

            <!-- Mobile Menu Toggle -->
            <button
                @click="mobileOpen = !mobileOpen"
                class="md:hidden p-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition"
            >
                <svg v-if="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <Transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="opacity-0 -translate-y-4"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-4"
        >
            <div v-if="mobileOpen" class="md:hidden glass border-t border-white/5">
                <div class="px-4 py-4 space-y-1">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 py-2">Games</div>
                    <router-link
                        v-for="game in games"
                        :key="game.slug"
                        :to="`/games/${game.slug}`"
                        class="block px-3 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition"
                        @click="mobileOpen = false"
                    >
                        {{ game.name }}
                    </router-link>
                    <div class="section-divider my-3"></div>
                    <router-link to="/contact" class="block px-3 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition" @click="mobileOpen = false">
                        Contact
                    </router-link>
                    <router-link
                        v-if="games.length"
                        :to="`/games/${games[0].slug}`"
                        class="block mt-3 px-4 py-3 rounded-lg text-center font-semibold bg-primary hover:bg-primary-dark text-white transition"
                        @click="mobileOpen = false"
                    >
                        Play Now
                    </router-link>
                </div>
            </div>
        </Transition>
    </header>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const games = ref([]);
const gamesOpen = ref(false);
const mobileOpen = ref(false);
const scrolled = ref(false);
const dropdownRef = ref(null);

function handleScroll() {
    scrolled.value = window.scrollY > 20;
}

function handleClickOutside(e) {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        gamesOpen.value = false;
    }
}

onMounted(async () => {
    const res = await fetch('/api/games');
    if (res.ok) games.value = await res.json();

    window.addEventListener('scroll', handleScroll, { passive: true });
    document.addEventListener('click', handleClickOutside);
    handleScroll();
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
    document.removeEventListener('click', handleClickOutside);
});
</script>
