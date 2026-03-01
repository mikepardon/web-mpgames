<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mpgames.io',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        Game::create([
            'name' => 'Trusted Advisors',
            'slug' => 'trusted-advisors',
            'short_description' => 'A strategic multiplayer card and dice game of deception and alliances.',
            'description' => "Trusted Advisors is a strategic multiplayer game where players take on the roles of advisors competing for influence in a royal court. Use cards and dice to forge alliances, deceive opponents, and emerge as the most trusted advisor.\n\nNavigate complex social dynamics, manage your resources wisely, and know when to betray your allies for the ultimate victory.",
            'features' => [
                'Strategic card and dice gameplay',
                'Multiplayer social deduction',
                'Dynamic alliance system',
                'Multiple win conditions',
                'Real-time online play',
            ],
            'play_url' => 'https://ta.mpgames.io',
            'status' => 'published',
            'sort_order' => 1,
        ]);

        Game::create([
            'name' => 'Dice Wars',
            'slug' => 'dice-wars',
            'short_description' => 'A competitive dice rolling game of risk and reward.',
            'description' => "Dice Wars is a fast-paced competitive game where players battle for territory using dice rolls. Expand your empire, defend your borders, and crush your opponents in this exciting game of strategy and luck.\n\nSimple to learn but difficult to master, Dice Wars offers endless replayability with procedurally generated maps and balanced gameplay.",
            'features' => [
                'Competitive territory control',
                'Quick-play dice battles',
                'Procedurally generated maps',
                'Ranked matchmaking',
                'Cross-platform play',
            ],
            'play_url' => 'https://dicewars.mpgames.io',
            'status' => 'published',
            'sort_order' => 2,
        ]);

        Page::create([
            'slug' => 'privacy-policy',
            'title' => 'Privacy Policy',
            'content' => "Last updated: January 1, 2025\n\n1. Introduction\nWelcome to MPGames (\"we\", \"our\", or \"us\"). We respect your privacy and are committed to protecting your personal data.\n\n2. Information We Collect\nWe may collect information you provide directly to us, such as your name, email address, and any other information you choose to provide when creating an account or contacting us.\n\n3. How We Use Your Information\nWe use the information we collect to:\n- Provide, maintain, and improve our services\n- Send you technical notices and support messages\n- Respond to your comments and questions\n\n4. Data Security\nWe implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.\n\n5. Contact Us\nIf you have any questions about this Privacy Policy, please contact us at contact@mpgames.io.",
        ]);

        Page::create([
            'slug' => 'terms-and-conditions',
            'title' => 'Terms & Conditions',
            'content' => "Last updated: January 1, 2025\n\n1. Acceptance of Terms\nBy accessing and using MPGames services, you agree to be bound by these Terms and Conditions.\n\n2. Use of Services\nYou agree to use our services only for lawful purposes and in accordance with these Terms. You agree not to:\n- Use the services in any way that violates any applicable law or regulation\n- Engage in any conduct that restricts or inhibits anyone's use of the services\n- Attempt to gain unauthorized access to any part of the services\n\n3. Accounts\nWhen you create an account, you must provide accurate and complete information. You are responsible for maintaining the confidentiality of your account credentials.\n\n4. Intellectual Property\nThe services and their original content, features, and functionality are owned by MPGames and are protected by international copyright, trademark, and other intellectual property laws.\n\n5. Limitation of Liability\nIn no event shall MPGames be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of the services.\n\n6. Contact Us\nIf you have any questions about these Terms, please contact us at contact@mpgames.io.",
        ]);
    }
}
