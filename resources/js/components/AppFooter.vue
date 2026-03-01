<template>
    <footer class="relative border-t border-white/5 overflow-hidden">
        <!-- Background glow -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-[200px] bg-primary/5 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main footer -->
            <div class="py-16 grid sm:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Brand -->
                <div class="sm:col-span-2 lg:col-span-1">
                    <router-link to="/" class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary to-accent flex items-center justify-center font-black text-sm tracking-tight">
                            MP
                        </div>
                        <span class="text-xl font-bold tracking-tight">
                            <span class="text-white">MP</span><span class="text-primary-light">Games</span>
                        </span>
                    </router-link>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-xs">
                        Unique multiplayer games that bring people together. No downloads, no installs -- just play.
                    </p>
                </div>

                <!-- Games -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Games</h4>
                    <ul class="space-y-3">
                        <li v-for="game in games" :key="game.slug">
                            <router-link
                                :to="`/games/${game.slug}`"
                                class="text-sm text-gray-400 hover:text-white transition-colors duration-200"
                            >
                                {{ game.name }}
                            </router-link>
                        </li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Company</h4>
                    <ul class="space-y-3">
                        <li>
                            <router-link to="/contact" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">
                                Contact
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/privacy-policy" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">
                                Privacy Policy
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/terms" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">
                                Terms & Conditions
                            </router-link>
                        </li>
                    </ul>
                </div>

                <!-- Play Now -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Jump In</h4>
                    <p class="text-sm text-gray-400 mb-4">Ready to play? Pick a game and start immediately.</p>
                    <router-link
                        v-if="games.length"
                        :to="`/games/${games[0].slug}`"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold bg-primary/10 text-primary-light border border-primary/20 hover:bg-primary/20 hover:border-primary/40 transition-all duration-200"
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                        Play Now
                    </router-link>
                </div>
            </div>

            <!-- Bottom bar -->
            <div class="py-6 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-600">
                    &copy; {{ new Date().getFullYear() }} MPGames. All rights reserved.
                </div>
                <div class="flex items-center gap-6">
                    <router-link to="/privacy-policy" class="text-sm text-gray-600 hover:text-gray-400 transition">Privacy</router-link>
                    <router-link to="/terms" class="text-sm text-gray-600 hover:text-gray-400 transition">Terms</router-link>
                    <router-link to="/contact" class="text-sm text-gray-600 hover:text-gray-400 transition">Contact</router-link>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const games = ref([]);

onMounted(async () => {
    const res = await fetch('/api/games');
    if (res.ok) games.value = await res.json();
});
</script>