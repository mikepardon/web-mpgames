import { reactive } from 'vue';

const state = reactive({
    user: null,
    token: localStorage.getItem('token'),
    loading: false,
});

async function apiFetch(url, options = {}) {
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        ...options.headers,
    };
    if (state.token) {
        headers['Authorization'] = `Bearer ${state.token}`;
    }
    const res = await fetch(url, { ...options, headers });
    if (res.status === 401) {
        state.user = null;
        state.token = null;
        localStorage.removeItem('token');
    }
    return res;
}

async function login(email, password) {
    const res = await fetch('/api/admin/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({ email, password }),
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Login failed');
    state.token = data.token;
    state.user = data.user;
    localStorage.setItem('token', data.token);
    return data;
}

async function logout() {
    await apiFetch('/api/admin/logout', { method: 'POST' });
    state.user = null;
    state.token = null;
    localStorage.removeItem('token');
}

async function fetchUser() {
    if (!state.token) return null;
    state.loading = true;
    try {
        const res = await apiFetch('/api/admin/me');
        if (res.ok) {
            state.user = await res.json();
        } else {
            state.user = null;
            state.token = null;
            localStorage.removeItem('token');
        }
    } finally {
        state.loading = false;
    }
    return state.user;
}

export { state, apiFetch, login, logout, fetchUser };
