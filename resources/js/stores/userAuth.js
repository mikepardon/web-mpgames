import { reactive } from 'vue';

const AUTH_URL = import.meta.env.VITE_AUTH_PROVIDER_URL || 'https://auth.mpgames.io';
const CLIENT_ID = import.meta.env.VITE_AUTH_OAUTH_CLIENT_ID || '';

const state = reactive({
    user: JSON.parse(localStorage.getItem('oauth_user') || 'null'),
    token: localStorage.getItem('oauth_token'),
});

function generateRandomString(length) {
    const array = new Uint8Array(length);
    crypto.getRandomValues(array);
    return Array.from(array, b => b.toString(16).padStart(2, '0')).join('').slice(0, length);
}

async function generateCodeChallenge(verifier) {
    const encoder = new TextEncoder();
    const data = encoder.encode(verifier);
    const digest = await crypto.subtle.digest('SHA-256', data);
    return btoa(String.fromCharCode(...new Uint8Array(digest)))
        .replace(/\+/g, '-')
        .replace(/\//g, '_')
        .replace(/=+$/, '');
}

async function loginRedirect() {
    const codeVerifier = generateRandomString(128);
    const codeChallenge = await generateCodeChallenge(codeVerifier);
    const stateParam = generateRandomString(40);

    sessionStorage.setItem('oauth_code_verifier', codeVerifier);
    sessionStorage.setItem('oauth_state', stateParam);
    sessionStorage.setItem('oauth_return_url', window.location.pathname + window.location.search);

    const params = new URLSearchParams({
        client_id: CLIENT_ID,
        redirect_uri: window.location.origin + '/auth/callback',
        response_type: 'code',
        scope: '',
        state: stateParam,
        code_challenge: codeChallenge,
        code_challenge_method: 'S256',
    });

    window.location.href = `${AUTH_URL}/oauth/authorize?${params}`;
}

async function handleCallback(code, returnedState) {
    const savedState = sessionStorage.getItem('oauth_state');
    const codeVerifier = sessionStorage.getItem('oauth_code_verifier');

    if (returnedState !== savedState) {
        throw new Error('State mismatch');
    }

    const tokenResponse = await fetch(`${AUTH_URL}/oauth/token`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({
            grant_type: 'authorization_code',
            client_id: CLIENT_ID,
            redirect_uri: window.location.origin + '/auth/callback',
            code_verifier: codeVerifier,
            code,
        }),
    });

    if (!tokenResponse.ok) {
        throw new Error('Token exchange failed');
    }

    const tokenData = await tokenResponse.json();
    state.token = tokenData.access_token;
    localStorage.setItem('oauth_token', state.token);

    const userResponse = await fetch(`${AUTH_URL}/api/user`, {
        headers: {
            'Authorization': `Bearer ${state.token}`,
            'Accept': 'application/json',
        },
    });

    if (userResponse.ok) {
        state.user = await userResponse.json();
        localStorage.setItem('oauth_user', JSON.stringify(state.user));
    }

    sessionStorage.removeItem('oauth_code_verifier');
    sessionStorage.removeItem('oauth_state');

    const returnUrl = sessionStorage.getItem('oauth_return_url') || '/';
    sessionStorage.removeItem('oauth_return_url');

    return returnUrl;
}

async function userFetch(url, options = {}) {
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        ...options.headers,
    };
    if (state.token) {
        headers['Authorization'] = `Bearer ${state.token}`;
    }
    return fetch(url, { ...options, headers });
}

function logout() {
    state.user = null;
    state.token = null;
    localStorage.removeItem('oauth_token');
    localStorage.removeItem('oauth_user');
}

export { state, loginRedirect, handleCallback, userFetch, logout };
