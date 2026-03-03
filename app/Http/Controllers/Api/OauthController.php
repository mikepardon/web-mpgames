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
            'redirect_uri' => 'required|string',
        ]);

        $authUrl = config('services.auth_provider.url');

        // Exchange code for token (server-to-server, no CORS)
        // Must use asForm() - OAuth token endpoints expect x-www-form-urlencoded
        $tokenResponse = Http::asForm()->acceptJson()->post($authUrl . '/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.auth_provider.client_id'),
            'redirect_uri' => $request->redirect_uri,
            'code_verifier' => $request->code_verifier,
            'code' => $request->code,
        ]);

        if (!$tokenResponse->successful()) {
            return response()->json([
                'message' => 'Token exchange failed',
                'error' => $tokenResponse->json(),
            ], $tokenResponse->status());
        }

        $tokenData = $tokenResponse->json();
        $accessToken = $tokenData['access_token'];

        // Fetch user info from auth provider
        $userResponse = Http::withToken($accessToken)
            ->acceptJson()
            ->get($authUrl . '/api/user');

        if (!$userResponse->successful()) {
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
            'access_token' => $accessToken,
            'user' => $oauthUser,
        ]);
    }
}
