<template>
    <div>
        <!-- Hero -->
        <section class="relative pt-32 pb-12 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-accent/10 via-surface to-primary/10"></div>
            <div class="absolute inset-0 bg-grid opacity-20"></div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
                    <router-link to="/" class="hover:text-white transition">Home</router-link>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    <router-link :to="`/games/${slug}`" class="hover:text-white transition">{{ gameName }}</router-link>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    <router-link :to="`/games/${slug}/ideas`" class="hover:text-white transition">Ideas</router-link>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    <span class="text-gray-300 truncate">{{ idea?.title }}</span>
                </div>
            </div>
        </section>

        <!-- Content -->
        <section class="relative pb-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div v-if="loading" class="text-center py-20">
                    <div class="w-12 h-12 border-2 border-primary/30 border-t-primary rounded-full animate-spin mx-auto mb-4"></div>
                </div>

                <div v-else-if="idea" class="flex gap-6">
                    <!-- Vote column -->
                    <div class="hidden sm:flex shrink-0 flex-col items-center gap-1 pt-2">
                        <button
                            @click="toggleVote"
                            :class="[
                                'w-14 h-14 rounded-xl flex flex-col items-center justify-center font-bold transition-all duration-200',
                                userVoted
                                    ? 'bg-primary/20 text-primary-light border border-primary/30'
                                    : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white border border-white/5'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
                            {{ idea.votes_count }}
                        </button>
                    </div>

                    <!-- Main content -->
                    <div class="flex-1 min-w-0">
                        <div class="glass rounded-xl p-6 sm:p-8 mb-8">
                            <div class="flex flex-wrap items-center gap-3 mb-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wide" :class="statusBadgeClass(idea.status)">
                                    {{ statusLabel(idea.status) }}
                                </span>

                                <!-- Mobile vote button -->
                                <button
                                    @click="toggleVote"
                                    :class="[
                                        'sm:hidden flex items-center gap-1.5 px-3 py-1 rounded-lg text-sm font-bold transition-all',
                                        userVoted
                                            ? 'bg-primary/20 text-primary-light border border-primary/30'
                                            : 'bg-white/5 text-gray-400 border border-white/5'
                                    ]"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
                                    {{ idea.votes_count }}
                                </button>
                            </div>

                            <h1 class="text-2xl sm:text-3xl font-black text-white mb-4">{{ idea.title }}</h1>
                            <p class="text-gray-300 leading-relaxed whitespace-pre-line mb-6">{{ idea.description }}</p>

                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <div v-if="idea.author?.avatar_url" class="w-6 h-6 rounded-full overflow-hidden">
                                        <img :src="idea.author.avatar_url" :alt="idea.author.username" class="w-full h-full object-cover" />
                                    </div>
                                    <div v-else class="w-6 h-6 rounded-full bg-primary/20 flex items-center justify-center text-[10px] font-bold text-primary-light">
                                        {{ (idea.author?.username || '?')[0].toUpperCase() }}
                                    </div>
                                    <span>{{ idea.author?.username || 'Unknown' }}</span>
                                </div>
                                <span>{{ formatDate(idea.created_at) }}</span>
                            </div>
                        </div>

                        <!-- Comments -->
                        <div>
                            <h2 class="text-xl font-bold text-white mb-6">Comments ({{ idea.comments?.length || 0 }})</h2>

                            <!-- Add comment -->
                            <div v-if="user" class="glass rounded-xl p-5 mb-6">
                                <form @submit.prevent="submitComment">
                                    <textarea
                                        v-model="commentBody"
                                        required
                                        maxlength="2000"
                                        rows="3"
                                        class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-primary transition resize-none mb-3"
                                        placeholder="Write a comment..."
                                    ></textarea>
                                    <div class="flex justify-end">
                                        <button type="submit" :disabled="sendingComment" class="px-5 py-2 rounded-xl font-bold text-sm bg-primary hover:bg-primary-dark text-white transition disabled:opacity-50">
                                            {{ sendingComment ? 'Posting...' : 'Post Comment' }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div v-else class="glass rounded-xl p-5 mb-6 text-center">
                                <button @click="loginRedirect()" class="text-primary-light hover:text-white transition font-medium">
                                    Sign in to comment
                                </button>
                            </div>

                            <!-- Comments list -->
                            <div v-if="idea.comments?.length" class="space-y-4">
                                <div v-for="comment in idea.comments" :key="comment.id" class="glass rounded-xl p-5">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-2">
                                            <div v-if="comment.author?.avatar_url" class="w-7 h-7 rounded-full overflow-hidden">
                                                <img :src="comment.author.avatar_url" :alt="comment.author.username" class="w-full h-full object-cover" />
                                            </div>
                                            <div v-else class="w-7 h-7 rounded-full bg-primary/20 flex items-center justify-center text-[10px] font-bold text-primary-light">
                                                {{ (comment.author?.username || '?')[0].toUpperCase() }}
                                            </div>
                                            <span class="text-sm font-medium text-white">{{ comment.author?.username || 'Unknown' }}</span>
                                            <span class="text-xs text-gray-500">{{ formatDate(comment.created_at) }}</span>
                                        </div>
                                        <button
                                            v-if="user && comment.oauth_user_id === user.id"
                                            @click="deleteComment(comment)"
                                            class="text-xs text-gray-500 hover:text-red-400 transition"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                    <p class="text-gray-300 text-sm leading-relaxed whitespace-pre-line">{{ comment.body }}</p>
                                </div>
                            </div>
                            <div v-else class="text-center py-8 text-gray-500 text-sm">
                                No comments yet. Be the first to share your thoughts.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import { state as userState, loginRedirect, userFetch } from '../stores/userAuth.js';

const route = useRoute();
const slug = ref(route.params.slug);
const gameName = ref('');
const idea = ref(null);
const loading = ref(true);
const commentBody = ref('');
const sendingComment = ref(false);

const user = computed(() => userState.user);

const userVoted = computed(() => {
    if (!user.value || !idea.value?.votes) return false;
    return idea.value.votes.some(v => v.oauth_user_id === user.value.id);
});

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
    const map = { new: 'New', rejected: 'Rejected', in_progress: 'In Progress', in_beta_testing: 'Beta Testing', live: 'Live' };
    return map[status] || status;
}

function formatDate(dateStr) {
    return new Date(dateStr).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

async function loadData() {
    loading.value = true;
    slug.value = route.params.slug;
    const ideaId = route.params.id;

    const [gameRes, ideaRes] = await Promise.all([
        fetch(`/api/games/${slug.value}`),
        fetch(`/api/games/${slug.value}/ideas/${ideaId}`),
    ]);

    if (gameRes.ok) {
        const game = await gameRes.json();
        gameName.value = game.name;
    }
    if (ideaRes.ok) {
        idea.value = await ideaRes.json();
    }
    loading.value = false;
}

async function toggleVote() {
    if (!user.value) {
        loginRedirect();
        return;
    }
    const res = await userFetch(`/api/ideas/${idea.value.id}/vote`, { method: 'POST' });
    if (res.ok) {
        const data = await res.json();
        idea.value.votes_count = data.votes_count;
        if (data.voted) {
            idea.value.votes.push({ oauth_user_id: user.value.id });
        } else {
            idea.value.votes = idea.value.votes.filter(v => v.oauth_user_id !== user.value.id);
        }
    }
}

async function submitComment() {
    sendingComment.value = true;
    const res = await userFetch(`/api/ideas/${idea.value.id}/comments`, {
        method: 'POST',
        body: JSON.stringify({ body: commentBody.value }),
    });
    if (res.ok) {
        const comment = await res.json();
        idea.value.comments.push(comment);
        commentBody.value = '';
    }
    sendingComment.value = false;
}

async function deleteComment(comment) {
    if (!confirm('Delete this comment?')) return;
    const res = await userFetch(`/api/ideas/comments/${comment.id}`, { method: 'DELETE' });
    if (res.ok) {
        idea.value.comments = idea.value.comments.filter(c => c.id !== comment.id);
    }
}

onMounted(loadData);
watch(() => route.params.id, loadData);
</script>
