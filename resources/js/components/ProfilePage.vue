<template>
    <div>
        <!-- Hero -->
        <section class="relative pt-32 pb-16 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-surface to-accent/10"></div>
            <div class="absolute inset-0 bg-grid opacity-20"></div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl sm:text-5xl font-black text-white mb-2">My Profile</h1>
                <p class="text-lg text-gray-400">Manage your account and see your contributions.</p>
            </div>
        </section>

        <section class="relative py-10">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Not signed in -->
                <div v-if="!user" class="text-center py-20">
                    <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <p class="text-gray-400 mb-4">Sign in to view your profile.</p>
                    <button @click="loginRedirect()" class="px-6 py-3 rounded-xl font-bold bg-primary hover:bg-primary-dark text-white transition">
                        Sign In
                    </button>
                </div>

                <!-- Signed in -->
                <div v-else>
                    <!-- User card -->
                    <div class="glass rounded-2xl p-8 mb-10">
                        <div class="flex items-center gap-5">
                            <div v-if="user.avatar_url" class="w-16 h-16 rounded-2xl overflow-hidden shrink-0">
                                <img :src="user.avatar_url" :alt="user.name || user.username" class="w-full h-full object-cover" />
                            </div>
                            <div v-else class="w-16 h-16 rounded-2xl bg-primary/20 flex items-center justify-center text-2xl font-black text-primary-light shrink-0">
                                {{ ((user.name || user.username || '?')[0]).toUpperCase() }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h2 class="text-2xl font-bold text-white">{{ user.name || user.username }}</h2>
                                <p v-if="user.email" class="text-gray-400 text-sm mt-0.5">{{ user.email }}</p>
                            </div>
                            <button
                                @click="handleLogout"
                                class="shrink-0 px-5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition"
                            >
                                Sign Out
                            </button>
                        </div>
                    </div>

                    <!-- My Ideas -->
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                            <div class="w-1 h-7 bg-accent rounded-full"></div>
                            My Ideas
                        </h2>

                        <div v-if="loadingIdeas" class="text-center py-12">
                            <div class="w-10 h-10 border-2 border-primary/30 border-t-primary rounded-full animate-spin mx-auto mb-3"></div>
                        </div>

                        <div v-else-if="!ideas.length" class="glass rounded-xl p-8 text-center">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                            </div>
                            <p class="text-gray-500 mb-4">You haven't submitted any ideas yet.</p>
                            <p class="text-gray-600 text-sm">Visit a game's Ideas Board to suggest a feature.</p>
                        </div>

                        <div v-else class="space-y-4">
                            <router-link
                                v-for="idea in ideas"
                                :key="idea.id"
                                :to="`/games/${idea.game?.slug || ''}/ideas/${idea.id}`"
                                class="flex gap-4 glass rounded-xl p-5 hover:bg-white/[0.04] transition-all duration-200 group"
                            >
                                <!-- Vote count -->
                                <div class="shrink-0 w-12 h-12 rounded-xl flex flex-col items-center justify-center text-sm font-bold bg-white/5 text-gray-400 border border-white/5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
                                    {{ idea.votes_count }}
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-1">
                                        <h3 class="font-bold text-white group-hover:text-primary-light transition-colors">{{ idea.title }}</h3>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide" :class="statusBadgeClass(idea.status)">
                                            {{ statusLabel(idea.status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-400 line-clamp-2 mb-2">{{ idea.description }}</p>
                                    <div class="flex items-center gap-3 text-xs text-gray-500">
                                        <span v-if="idea.game" class="text-primary-light/70">{{ idea.game.name }}</span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                                            {{ idea.comments_count || 0 }}
                                        </span>
                                        <span>{{ formatDate(idea.created_at) }}</span>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { useRouter } from 'vue-router';
import { state as userState, loginRedirect, logout, userFetch } from '../stores/userAuth.js';

const router = useRouter();
const user = computed(() => userState.user);
const ideas = ref([]);
const loadingIdeas = ref(false);

function statusBadgeClass(status) {
    const map = {
        new: 'bg-blue-500/10 text-blue-400 border border-blue-500/20',
        rejected: 'bg-red-500/10 text-red-400 border border-red-500/20',
        in_progress: 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20',
        in_beta_testing: 'bg-purple-500/10 text-purple-400 border border-purple-500/20',
        live: 'bg-green-500/10 text-green-400 border border-green-500/20',
    };
    return map[status] || map.new;
}

function statusLabel(status) {
    const map = { new: 'New', rejected: 'Rejected', in_progress: 'In Progress', in_beta_testing: 'Beta', live: 'Live' };
    return map[status] || status;
}

function formatDate(dateStr) {
    return new Date(dateStr).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

async function loadIdeas() {
    if (!user.value) return;
    loadingIdeas.value = true;
    const res = await userFetch('/api/profile/ideas');
    if (res.ok) {
        ideas.value = await res.json();
    }
    loadingIdeas.value = false;
}

function handleLogout() {
    logout();
    router.push('/');
}

onMounted(loadIdeas);
watch(user, (val) => { if (val) loadIdeas(); });
</script>
