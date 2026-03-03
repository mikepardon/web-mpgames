<?php

namespace App\Http\Middleware;

use App\Models\OauthUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class OauthUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $cacheKey = 'oauth_user_' . hash('sha256', $token);

        $userData = Cache::remember($cacheKey, 300, function () use ($token) {
            $response = Http::withToken($token)
                ->acceptJson()
                ->get(config('services.auth_provider.url') . '/api/user');

            if (!$response->successful()) {
                return null;
            }

            return $response->json();
        });

        if (!$userData) {
            Cache::forget($cacheKey);
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $oauthUser = OauthUser::updateOrCreate(
            ['oauth_id' => $userData['id']],
            [
                'username' => $userData['name'] ?? $userData['username'] ?? 'Unknown',
                'email' => $userData['email'] ?? null,
                'avatar_url' => $userData['avatar_url'] ?? null,
            ]
        );

        $request->merge(['oauth_user' => $oauthUser]);
        $request->attributes->set('oauth_user', $oauthUser);

        return $next($request);
    }
}
