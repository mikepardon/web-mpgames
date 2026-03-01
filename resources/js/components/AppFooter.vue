<template>
    <footer class="bg-surface border-t border-slate-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-slate-400">
                    &copy; {{ new Date().getFullYear() }} MPGames. All rights reserved.
                </div>
                <div class="flex gap-6">
                    <router-link to="/privacy-policy" class="text-slate-400 hover:text-white transition">Privacy Policy</router-link>
                    <router-link to="/terms" class="text-slate-400 hover:text-white transition">Terms & Conditions</router-link>
                    <router-link to="/contact" class="text-slate-400 hover:text-white transition">Contact</router-link>
                </div>
            </div>
        </div>
    </footer>
</template>
