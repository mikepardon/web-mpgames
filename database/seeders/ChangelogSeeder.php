<?php

namespace Database\Seeders;

use App\Models\ChangelogEntry;
use Illuminate\Database\Seeder;

class ChangelogSeeder extends Seeder
{
    public function run(): void
    {
        $entries = [
            [
                'game_id' => 1,
                'version' => '0.1.0',
                'title' => 'Initial Release - Real-time Multiplayer',
                'description' => 'Launched Trusted Advisors with real-time multiplayer infrastructure powered by WebSockets (Laravel Reverb/Pusher). Play with friends in your browser with live game state synchronization.',
                'published_at' => '2026-02-27',
                'category' => 'feature',
            ],
            [
                'game_id' => 1,
                'version' => '0.2.0',
                'title' => 'Achievements & Account Registration',
                'description' => 'Added an achievements system to track your accomplishments and milestones. Players can now register with email for a persistent account and progress tracking.',
                'published_at' => '2026-02-28',
                'category' => 'feature',
            ],
            [
                'game_id' => 1,
                'version' => '0.3.0',
                'title' => 'New Authentication Flow',
                'description' => 'Redesigned the authentication system with OAuth2 integration for a seamless and secure login experience across all MPGames titles.',
                'published_at' => '2026-03-01',
                'category' => 'improvement',
            ],
            [
                'game_id' => 1,
                'version' => '0.4.0',
                'title' => 'Replay Sharing & Matchmaking',
                'description' => 'Share your best game replays with friends and the community. New matchmaking system helps you find opponents faster so you spend less time waiting and more time playing.',
                'published_at' => '2026-03-01',
                'category' => 'feature',
            ],
            [
                'game_id' => 1,
                'version' => '0.4.1',
                'title' => 'Account Deletion Support',
                'description' => 'Added account deletion via webhook integration, giving players full control over their data in compliance with privacy requirements.',
                'published_at' => '2026-03-01',
                'category' => 'feature',
            ],
            [
                'game_id' => 1,
                'version' => '0.4.2',
                'title' => 'Login Flow & Achievement Fixes',
                'description' => 'Fixed issues with the login flow and resolved bugs in the achievements system for more reliable tracking and display.',
                'published_at' => '2026-03-01',
                'category' => 'bug_fix',
            ],
            [
                'game_id' => 1,
                'version' => '0.5.0',
                'title' => 'AI Bot Opponents',
                'description' => 'Play against AI bots when friends are not available. Practice your strategies and sharpen your skills against computer-controlled opponents with varying difficulty.',
                'published_at' => '2026-03-01',
                'category' => 'feature',
            ],
            [
                'game_id' => 1,
                'version' => '0.5.1',
                'title' => 'CSRF Security Fix',
                'description' => 'Fixed CSRF token validation issues to ensure secure form submissions and protect against cross-site request forgery attacks.',
                'published_at' => '2026-03-02',
                'category' => 'bug_fix',
            ],
            [
                'game_id' => 1,
                'version' => '0.6.0',
                'title' => 'Duel Mode & Scoring System',
                'description' => 'Introducing Duel mode with new competitive game logic and a comprehensive scoring system. Challenge a single opponent to an intense head-to-head match with detailed score breakdowns.',
                'published_at' => '2026-03-03',
                'category' => 'feature',
            ],
            [
                'game_id' => 1,
                'version' => '0.6.1',
                'title' => 'Custom Usernames',
                'description' => 'Players can now set and customize their display username, making it easier to identify friends and opponents in-game.',
                'published_at' => '2026-03-03',
                'category' => 'feature',
            ],
        ];

        foreach ($entries as $entry) {
            ChangelogEntry::create($entry);
        }
    }
}
