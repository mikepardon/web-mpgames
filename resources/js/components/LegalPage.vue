<template>
    <div class="relative min-h-screen">
        <div class="absolute inset-0 bg-surface">
            <div class="absolute inset-0 bg-grid opacity-20"></div>
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div v-if="page">
                <div class="mb-10">
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                        <router-link to="/" class="hover:text-gray-300 transition">Home</router-link>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-gray-400">{{ page.title }}</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-black text-white">{{ page.title }}</h1>
                </div>
                <div class="glass rounded-2xl p-8 sm:p-12">
                    <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed whitespace-pre-line text-base">{{ page.content }}</div>
                </div>
            </div>
            <div v-else class="flex items-center justify-center py-32">
                <div class="w-10 h-10 border-2 border-primary/30 border-t-primary rounded-full animate-spin"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';

const props = defineProps({
    slug: String,
});

const route = useRoute();
const page = ref(null);

async function loadPage() {
    const slug = props.slug || route.params.slug;
    const res = await fetch(`/api/pages/${slug}`);
    if (res.ok) page.value = await res.json();
}

onMounted(loadPage);
watch(() => props.slug, loadPage);
</script>