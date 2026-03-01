<template>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-surface border-r border-slate-800 flex flex-col">
            <div class="p-4 border-b border-slate-800">
                <router-link to="/" class="text-xl font-bold text-primary">MPGames</router-link>
                <span class="text-xs text-slate-500 ml-2">Admin</span>
            </div>
            <nav class="flex-1 p-4 space-y-1">
                <router-link
                    to="/admin"
                    class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-surface-light transition"
                    :class="{ 'bg-surface-light text-white': $route.path === '/admin' }"
                >
                    Dashboard
                </router-link>
                <router-link
                    to="/admin/games"
                    class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-surface-light transition"
                    :class="{ 'bg-surface-light text-white': $route.path.startsWith('/admin/games') }"
                >
                    Games
                </router-link>
                <router-link
                    to="/admin/pages"
                    class="block px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-surface-light transition"
                    :class="{ 'bg-surface-light text-white': $route.path.startsWith('/admin/pages') }"
                >
                    Pages
                </router-link>
            </nav>
            <div class="p-4 border-t border-slate-800">
                <button @click="handleLogout" class="w-full text-left px-3 py-2 text-slate-400 hover:text-white transition">
                    Logout
                </button>
            </div>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-8">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { logout } from '../../stores/auth.js';

const router = useRouter();

async function handleLogout() {
    await logout();
    router.push('/admin/login');
}
</script>
