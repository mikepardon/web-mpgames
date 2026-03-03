import { createRouter, createWebHistory } from 'vue-router';
import { state, fetchUser } from './stores/auth.js';

import HomePage from './components/HomePage.vue';
import GamePage from './components/GamePage.vue';
import LegalPage from './components/LegalPage.vue';
import ContactPage from './components/ContactPage.vue';
import AuthCallback from './components/AuthCallback.vue';
import ChangelogPage from './components/ChangelogPage.vue';
import IdeasPage from './components/IdeasPage.vue';
import IdeaDetailPage from './components/IdeaDetailPage.vue';
import AdminLogin from './components/admin/AdminLogin.vue';
import AdminDashboard from './components/admin/AdminDashboard.vue';
import AdminGames from './components/admin/AdminGames.vue';
import AdminGameForm from './components/admin/AdminGameForm.vue';
import AdminPages from './components/admin/AdminPages.vue';
import AdminPageEdit from './components/admin/AdminPageEdit.vue';
import AdminChangelog from './components/admin/AdminChangelog.vue';
import AdminChangelogForm from './components/admin/AdminChangelogForm.vue';
import AdminIdeas from './components/admin/AdminIdeas.vue';
import ProfilePage from './components/ProfilePage.vue';

const routes = [
    { path: '/', component: HomePage },
    { path: '/profile', component: ProfilePage },
    { path: '/games/:slug', component: GamePage },
    { path: '/games/:slug/changelog', component: ChangelogPage },
    { path: '/games/:slug/ideas', component: IdeasPage },
    { path: '/games/:slug/ideas/:id', component: IdeaDetailPage },
    { path: '/auth/callback', component: AuthCallback },
    { path: '/privacy-policy', component: LegalPage, props: { slug: 'privacy-policy' } },
    { path: '/terms', component: LegalPage, props: { slug: 'terms-and-conditions' } },
    { path: '/contact', component: ContactPage },
    { path: '/admin/login', component: AdminLogin },
    { path: '/admin', component: AdminDashboard, meta: { requiresAuth: true } },
    { path: '/admin/games', component: AdminGames, meta: { requiresAuth: true } },
    { path: '/admin/games/new', component: AdminGameForm, meta: { requiresAuth: true } },
    { path: '/admin/games/:id/edit', component: AdminGameForm, meta: { requiresAuth: true } },
    { path: '/admin/games/:id/changelog', component: AdminChangelog, meta: { requiresAuth: true } },
    { path: '/admin/games/:id/changelog/new', component: AdminChangelogForm, meta: { requiresAuth: true } },
    { path: '/admin/games/:id/changelog/:entryId/edit', component: AdminChangelogForm, meta: { requiresAuth: true } },
    { path: '/admin/games/:id/ideas', component: AdminIdeas, meta: { requiresAuth: true } },
    { path: '/admin/pages', component: AdminPages, meta: { requiresAuth: true } },
    { path: '/admin/pages/:id/edit', component: AdminPageEdit, meta: { requiresAuth: true } },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to) => {
    if (to.meta.requiresAuth) {
        if (!state.user && state.token) {
            await fetchUser();
        }
        if (!state.user) {
            return '/admin/login';
        }
    }
});

export default router;
