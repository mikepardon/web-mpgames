<template>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div v-if="page">
            <h1 class="text-4xl font-bold mb-8">{{ page.title }}</h1>
            <div class="prose prose-invert max-w-none text-slate-300 whitespace-pre-line">{{ page.content }}</div>
        </div>
        <div v-else class="text-center text-slate-400">Loading...</div>
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
