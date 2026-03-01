<template>
    <div class="min-h-screen flex flex-col">
        <AppHeader v-if="!isAdmin" />
        <main class="flex-1">
            <router-view />
        </main>
        <AppFooter v-if="!isAdmin" />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import AppHeader from './AppHeader.vue';
import AppFooter from './AppFooter.vue';

const route = useRoute();
const isAdmin = computed(() => route.path.startsWith('/admin'));
</script>
