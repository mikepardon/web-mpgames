<template>
    <div>
        <!-- Hero -->
        <section class="relative pt-32 pb-16 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-accent/10 via-surface to-primary/10"></div>
            <div class="absolute inset-0 bg-grid opacity-20"></div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
                    <router-link to="/" class="hover:text-white transition">Home</router-link>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    <router-link :to="`/games/${slug}`" class="hover:text-white transition">{{ gameName }}</router-link>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    <span class="text-gray-300">Ideas</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <div>
                        <h1 class="text-4xl sm:text-5xl font-black text-white mb-4">Ideas Board</h1>
                        <p class="text-lg text-gray-400">Suggest features, vote on ideas, and help shape {{ gameName }}.</p>
                    </div>
                    <button
                        v-if="user"
                        @click="showModal = true"
                        class="shrink-0 px-6 py-3 rounded-xl font-bold bg-primary hover:bg-primary-dark text-white btn-lift transition"
                    >
                        Submit Idea
                    </button>
                    <button
                        v-else
                        @click="loginRedirect()"
                        class="shrink-0 px-6 py-3 rounded-xl font-bold bg-white/10 hover:bg-white/20 text-white transition"
                    >
                        Sign in to Submit
                    </button>
                </div>
            </div>
        </section>

        <!-- Filters & List -->
        <section class="relative py-10">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Filters -->
                <div class="flex flex-wrap items-center gap-3 mb-8">
                    <div class="flex flex-wrap gap-2">
                        <button
                            v-for="f in statusFilters"
                            :key="f.value"
                            @click="statusFilter = f.value"
                            :class="[
                                'px-3 py-1.5 rounded-lg text-sm font-medium transition',
                                statusFilter === f.value ? 'bg-primary/20 text-primary-light border border-primary/30' : 'bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 border border-white/5'
                            ]"
                        >
                            {{ f.label }}
                        </button>
                    </div>
                    <div class="ml-auto">
                        <select
                            v-model="sort"
                            class="px-3 py-1.5 rounded-lg text-sm bg-white/5 border border-white/10 text-gray-300 focus:outline-none focus:border-primary"
                        >
                            <option value="newest">Newest</option>
                            <option value="most_voted">Most Voted</option>
                        </select>
                    </div>
                </div>

                <!-- Loading -->
                <div v-if="loading" class="text-center py-20">
                    <div class="w-12 h-12 border-2 border-primary/30 border-t-primary rounded-full animate-spin mx-auto mb-4"></div>
                </div>

                <!-- Empty -->
                <div v-else-if="!ideas.length" class="text-center py-20">
                    <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                    </div>
                    <p class="text-gray-500">No ideas yet. Be the first to suggest one!</p>
                </div>

                <!-- Ideas List -->
                <div v-else class="space-y-4">
                    <router-link
                        v-for="idea in ideas"
                        :key="idea.id"
                        :to="`/games/${slug}/ideas/${idea.id}`"
                        class="flex gap-4 glass rounded-xl p-5 hover:bg-white/[0.04] transition-all duration-200 group"
                    >
                        <!-- Vote button -->
                        <div class="shrink-0 flex flex-col items-center gap-1">
                            <button
                                @click.prevent="toggleVote(idea)"
                                :class="[
                                    'w-12 h-12 rounded-xl flex flex-col items-center justify-center text-sm font-bold transition-all duration-200',
                                    idea.user_voted
                                        ? 'bg-primary/20 text-primary-light border border-primary/30'
                                        : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white border border-white/5'
                                ]"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
                                {{ idea.votes_count }}
                            </button>
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
                                <span>by {{ idea.author?.username || 'Unknown' }}</span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                                    {{ idea.comments_count || 0 }}
                                </span>
                                <span>{{ formatDate(idea.created_at) }}</span>
                            </div>
                        </div>
                    </router-link>
                </div>

                <!-- Pagination -->
                <div v-if="lastPage > 1" class="flex justify-center gap-2 mt-10">
                    <button
                        v-for="p in lastPage"
                        :key="p"
                        @click="page = p"
                        :class="[
                            'w-10 h-10 rounded-lg text-sm font-medium transition',
                            page === p ? 'bg-primary text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10'
                        ]"
                    >
                        {{ p }}
                    </button>
                </div>
            </div>
        </section>

        <!-- Submit Modal -->
        <Teleport to="body">
            <Transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4">
                    <div class="absolute inset-0 bg-black/70" @click="showModal = false"></div>
                    <div class="relative glass rounded-2xl p-8 w-full max-w-lg">
                        <h2 class="text-2xl font-bold text-white mb-6">Submit an Idea</h2>
                        <form @submit.prevent="submitIdea">
                            <div class="mb-4">
                                <label class="block text-sm text-gray-400 mb-1">Title</label>
                                <input
                                    v-model="newIdea.title"
                                    required
                                    maxlength="255"
                                    class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-primary transition"
                                    placeholder="A short, descriptive title"
                                />
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm text-gray-400 mb-1">Description</label>
                                <textarea
                                    v-model="newIdea.description"
                                    required
                                    maxlength="5000"
                                    rows="5"
                                    class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-primary transition resize-none"
                                    placeholder="Describe your idea in detail..."
                                ></textarea>
                            </div>
                            <div v-if="submitError" class="text-red-400 text-sm mb-4">{{ submitError }}</div>
                            <div class="flex justify-end gap-3">
                                <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl text-gray-400 hover:text-white transition">Cancel</button>
                                <button type="submit" :disabled="submitting" class="px-6 py-2.5 rounded-xl font-bold bg-primary hover:bg-primary-dark text-white transition disabled:opacity-50">
                                    {{ submitting ? 'Submitting...' : 'Submit' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </Transition>
        </Teleport>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import { state as userState, loginRedirect, userFetch } from '../stores/userAuth.js';

const route = useRoute();
const slug = ref(route.params.slug);
const gameName = ref('');
const ideas = ref([]);
const loading = ref(true);
const page = ref(1);
const lastPage = ref(1);
const statusFilter = ref('all');
const sort = ref('newest');
const showModal = ref(false);
const submitting = ref(false);
const submitError = ref('');
const newIdea = ref({ title: '', description: '' });

const user = computed(() => userState.user);

const statusFilters = [
    { value: 'all', label: 'All' },
    { value: 'new', label: 'New' },
    { value: 'in_progress', label: 'In Progress' },
    { value: 'in_beta_testing', label: 'Beta Testing' },
    { value: 'live', label: 'Live' },
    { value: 'rejected', label: 'Rejected' },
];

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
    loading.value = true;
    const params = new URLSearchParams({ page: page.value, sort: sort.value });
    if (statusFilter.value !== 'all') params.set('status', statusFilter.value);

    const res = await fetch(`/api/games/${slug.value}/ideas?${params}`);
    if (res.ok) {
        const data = await res.json();
        ideas.value = data.data.map(idea => ({
            ...idea,
            user_voted: user.value ? idea.votes?.some(v => v.oauth_user_id === user.value.id) : false,
        }));
        lastPage.value = data.last_page;
    }
    loading.value = false;
}

async function loadGame() {
    const res = await fetch(`/api/games/${slug.value}`);
    if (res.ok) {
        const game = await res.json();
        gameName.value = game.name;
    }
}

async function toggleVote(idea) {
    if (!user.value) {
        loginRedirect();
        return;
    }
    const res = await userFetch(`/api/ideas/${idea.id}/vote`, { method: 'POST' });
    if (res.ok) {
        const data = await res.json();
        idea.votes_count = data.votes_count;
        idea.user_voted = data.voted;
    }
}

async function submitIdea() {
    submitting.value = true;
    submitError.value = '';
    const res = await userFetch(`/api/games/${slug.value}/ideas`, {
        method: 'POST',
        body: JSON.stringify(newIdea.value),
    });
    if (res.ok) {
        showModal.value = false;
        newIdea.value = { title: '', description: '' };
        page.value = 1;
        sort.value = 'newest';
        await loadIdeas();
    } else {
        const data = await res.json();
        submitError.value = data.message || 'Failed to submit idea';
    }
    submitting.value = false;
}

onMounted(() => {
    loadGame();
    loadIdeas();
});

watch([statusFilter, sort], () => { page.value = 1; loadIdeas(); });
watch(page, loadIdeas);
watch(() => route.params.slug, () => {
    slug.value = route.params.slug;
    loadGame();
    loadIdeas();
});
</script>
