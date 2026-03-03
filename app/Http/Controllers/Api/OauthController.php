<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OauthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OauthController extends Controller
{
    public function token(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'code_verifier' => 'required|string',
        ]);

        $authConfig = config('services.auth_provider');

        // Exchange code for token (server-to-server, no CORS)
        // Matches trusted-advisors pattern exactly
        $params = [
            'grant_type' => 'authorization_code',
            'client_id' => $authConfig['client_id'],
            'redirect_uri' => $authConfig['redirect_uri'],
            'code' => $request->code,
            'code_verifier' => $request->code_verifier,
        ];

        // Only include secret for Confidential clients
        if (!empty($authConfig['client_secret'])) {
            $params['client_secret'] = $authConfig['client_secret'];
        }

        $tokenResponse = Http::asForm()->post($authConfig['url'] . '/oauth/token', $params);

        if ($tokenResponse->failed()) {
            return response()->json([
                'message' => 'Token exchange failed',
            ], $tokenResponse->status());
        }

        $tokens = $tokenResponse->json();

        // Fetch user info from auth provider
        $userResponse = Http::withToken($tokens['access_token'])
            ->get($authConfig['url'] . '/api/user');

        if ($userResponse->failed()) {
            return response()->json([
                'message' => 'Failed to fetch user info',
            ], 500);
        }

        $userData = $userResponse->json();

        // Upsert local oauth user
        $oauthUser = OauthUser::updateOrCreate(
            ['oauth_id' => $userData['id']],
            [
                'username' => $userData['name'] ?? $userData['username'] ?? 'Unknown',
                'email' => $userData['email'] ?? null,
                'avatar_url' => $userData['avatar_url'] ?? null,
            ]
        );

        return response()->json([
            'access_token' => $tokens['access_token'],
            'user' => $oauthUser,
        ]);
    }
}
