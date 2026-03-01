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
            'short_description' => 'A strategic multiplayer card and dice game of deception and alliances. Forge pacts, betray friends, and claim the throne.',
            'description' => "Trusted Advisors is a strategic multiplayer game where players take on the roles of advisors competing for influence in a royal court. Use cards and dice to forge alliances, deceive opponents, and emerge as the most trusted advisor.\n\nNavigate complex social dynamics, manage your resources wisely, and know when to betray your allies for the ultimate victory.",
            'long_description' => "Every game of Trusted Advisors tells a different story. You'll start as one of several advisors vying for the King's favour, each with your own secret agenda. The cards you hold determine your abilities -- but it's how you play the people at the table that determines whether you win.\n\nThe dice add an element of controlled chaos to every encounter. Roll to resolve disputes, push your luck on risky schemes, or use loaded dice cards to tip the odds in your favour. But be careful -- other players are watching, and getting caught cheating has consequences.\n\nAlliances form and break naturally as the game progresses. You might team up with another player to take down a leading rival, only to stab them in the back when the moment is right. The game's trust system tracks how other players perceive you, opening or closing doors depending on your reputation.\n\nWith multiple paths to victory -- from political dominance to secret objective completion -- no two games ever play out the same way. Whether you prefer to play as a cunning manipulator, a loyal ally, or a wild card, Trusted Advisors has a playstyle for you.",
            'features' => [
                'Strategic card and dice gameplay',
                'Multiplayer social deduction',
                'Dynamic alliance and betrayal system',
                'Multiple win conditions and secret objectives',
                'Real-time online play with friends',
                'Trust and reputation tracking',
                'Unique advisor abilities and roles',
                'Loaded dice and cheat mechanics',
                'Persistent player stats and rankings',
                'Regular content updates and new cards',
            ],
            'modes' => [
                [
                    'name' => 'Co-op Mode',
                    'tag' => '2-6 Players',
                    'description' => 'Team up with friends against an AI-controlled rival faction threatening the kingdom. Pool your resources, coordinate strategies, and combine your unique advisor abilities to overcome increasingly difficult challenges. Communication and trust are everything -- but a hidden traitor mechanic means someone at the table might be working against you.',
                    'highlights' => [
                        'Cooperative campaign with escalating difficulty',
                        'AI-driven rival faction with adaptive strategy',
                        'Hidden traitor variant for added tension',
                        'Shared resource pool and team abilities',
                        'Unique co-op only cards and events',
                    ],
                ],
                [
                    'name' => 'Duel Mode',
                    'tag' => '1v1',
                    'description' => 'A stripped-down, high-intensity head-to-head experience. No alliances to hide behind, no one else to blame. Duel Mode is pure strategy -- read your opponent, manage your hand, and outplay them in a best-of-three format. Faster games, deeper mind games, and a ranked ladder to prove you are the best.',
                    'highlights' => [
                        'Intense 1v1 competitive matches',
                        'Best-of-three format with sideboarding',
                        'Dedicated ranked ladder and ELO rating',
                        'Faster pace -- games in under 15 minutes',
                        'Exclusive duel-only card pool',
                    ],
                ],
            ],
            'faq' => [
                [
                    'question' => 'How many players do I need to play?',
                    'answer' => 'Trusted Advisors supports 2-6 players. Duel Mode is designed for exactly 2 players, while Co-op Mode works best with 3-6. The classic competitive mode is best with 4-6 players but works with as few as 3.',
                ],
                [
                    'question' => 'How long does a typical game last?',
                    'answer' => 'Co-op games typically run around 15 minutes, while Duel Mode matches are even quicker at around 10 minutes. The classic competitive mode varies depending on player count but most games wrap up in 15-30 minutes.',
                ],
                [
                    'question' => 'Is there a single-player mode?',
                    'answer' => 'Yes! Trusted Advisors has a full single-player section where you can play through campaigns and challenges on your own. Duel Mode also supports playing against bots, so you can practice your strategy or just enjoy a quick game anytime.',
                ],
                [
                    'question' => 'Do I need to download anything?',
                    'answer' => 'No. Trusted Advisors runs entirely in your browser. Just create a free account, share the room link with friends, and start playing. Works on desktop, tablet, and mobile.',
                ],
                [
                    'question' => 'Is the game pay-to-win?',
                    'answer' => 'Absolutely not. All gameplay-affecting cards and mechanics are available to every player for free. Optional cosmetic add-ons like card skins, custom dice, and advisor portraits are available for purchase but provide no competitive advantage.',
                ],
                [
                    'question' => 'Can I play on my phone?',
                    'answer' => 'Yes! The game is fully responsive and works on mobile browsers. A native iOS and Android app is also coming soon for an even smoother mobile experience.',
                ],
                [
                    'question' => 'How do I invite friends to a game?',
                    'answer' => 'Create a room from the main menu and share the room link or code with your friends. They just click the link or enter the code to join -- no friend lists or accounts to connect.',
                ],
            ],
            'play_url' => 'https://ta.mpgames.io',
            'logo_url' => 'https://ta.mpgames.io/images/ta-icon.jpg',
            'banner_url' => 'https://ta.mpgames.io/images/banner.png',
            'status' => 'published',
            'coming_soon' => false,
            'sort_order' => 1,
        ]);

        Game::create([
            'name' => 'Dice Wars',
            'slug' => 'dice-wars',
            'short_description' => 'A competitive dice rolling game of risk and reward. Battle for territory, crush your rivals, and dominate the map.',
            'description' => "Dice Wars is a fast-paced competitive game where players battle for territory using dice rolls. Expand your empire, defend your borders, and crush your opponents in this exciting game of strategy and luck.\n\nSimple to learn but difficult to master, Dice Wars offers endless replayability with procedurally generated maps and balanced gameplay.",
            'long_description' => "Inspired by classic territory control games but reimagined for the modern web, Dice Wars drops you onto a procedurally generated hex map divided into regions. Each region you control has a stack of dice -- the more dice, the stronger your position.\n\nOn your turn, attack adjacent enemy regions by rolling your dice against theirs. Higher total wins. But overextending leaves your borders thin, and a single bad roll can collapse an empire. The tension between expanding aggressively and consolidating your defences is what makes every game gripping.\n\nMultiple map sizes and player counts mean you can have a quick 5-minute skirmish or an epic hour-long war. The ranked matchmaking system ensures fair games, and the ELO-based ladder lets you prove your mastery.",
            'features' => [
                'Competitive territory control',
                'Quick-play dice battles',
                'Procedurally generated hex maps',
                'Ranked matchmaking and ELO ladder',
                'Cross-platform play',
                'Multiple map sizes and player counts',
                'Real-time and turn-based variants',
                'Seasonal tournaments and rewards',
            ],
            'modes' => [
                [
                    'name' => 'Classic Mode',
                    'tag' => '2-8 Players',
                    'description' => 'The original Dice Wars experience. Conquer the map by attacking adjacent territories and eliminating all opponents. Last player standing wins.',
                    'highlights' => [
                        'Free-for-all territory conquest',
                        'Procedurally generated maps every game',
                        'Supports 2-8 players',
                    ],
                ],
                [
                    'name' => 'Blitz Mode',
                    'tag' => 'Speed Round',
                    'description' => 'Same rules, half the time. Blitz Mode adds a shot clock to every turn, forcing fast decisions and aggressive play. Perfect for quick matches.',
                    'highlights' => [
                        'Timed turns for rapid gameplay',
                        'Games finish in under 10 minutes',
                        'Separate ranked ladder',
                    ],
                ],
            ],
            'faq' => [
                [
                    'question' => 'When will Dice Wars be available?',
                    'answer' => 'Dice Wars is currently in development. We are targeting an early access launch soon -- follow us for updates and be the first to play.',
                ],
                [
                    'question' => 'Will there be a beta or early access?',
                    'answer' => 'Yes! We plan to run a public beta before the full launch. Create an account on auth.mpgames.io to be notified when beta access opens.',
                ],
                [
                    'question' => 'How is this different from other dice games?',
                    'answer' => 'Dice Wars combines the simplicity of dice rolling with deep territory control strategy. Every decision matters -- when to attack, when to hold, where to reinforce. The procedurally generated maps ensure no two games are alike.',
                ],
            ],
            'play_url' => 'https://dicewars.mpgames.io',
            'status' => 'published',
            'coming_soon' => true,
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
