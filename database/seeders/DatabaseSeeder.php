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
        User::updateOrCreate(
            ['email' => 'admin@mpgames.io'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        Game::updateOrCreate(
            ['slug' => 'trusted-advisors'],
            [
            'name' => 'Trusted Advisors',
            'short_description' => 'A strategic kingdom management game of cards, dice, and tough decisions. Keep the realm alive or watch it crumble.',
            'description' => "Trusted Advisors is a strategic card and dice game set in medieval England. You play as an advisor to the crown, making critical decisions each month to keep the kingdom alive. Balance six vital stats -- Wealth, Influence, Security, Religion, Food, and Happiness -- while facing increasingly difficult crises.\n\nEvery round, you draw decision cards and choose which to pursue and which to let happen. Roll your advisor's custom dice to overcome challenges, use items to turn the tide, and survive curses that threaten to unravel your plans. Let any stat hit zero and the kingdom falls.",
            'long_description' => "Each month in Trusted Advisors presents you with two decision cards. Assign one as your positive action -- something you'll actively roll dice to achieve -- and the other as a negative consequence that happens regardless. The tension between risk and reward is constant: a high-difficulty card might save your crumbling food supply, but failing the roll could tank your happiness instead.\n\nYour advisor isn't just a name. Each of the six characters -- from Lord William the diplomat to Meredith the Shadow -- has unique custom dice with different face values and a WILD ability that triggers special effects. Level up your advisor over multiple games, choosing upgrades like stronger dice faces, extra item slots, or stat bonuses that shape your playstyle.\n\nThe curses system adds another layer of strategy. When cursed, you choose from several options, each with a painful downside and a tempting reward -- lose a die permanently but gain 50% more XP, or suffer stat drain each round but boost your final score. Items range from simple roll bonuses to powerful effects like redrawing cards or removing curses, but you can only hold two at a time.\n\nKingdom events shake things up every few rounds -- plagues, bountiful harvests, bitter winters, and more. Difficulty scales as the months pass, and your final score is calculated from surviving stat totals, balance bonuses, and year multipliers. Chase high scores, climb the leaderboards, and see how long you can keep the kingdom standing.",
            'features' => [
                'Six kingdom stats to balance -- let any hit zero and you lose',
                'Unique advisors with custom dice and abilities',
                'Advisor leveling system with permanent upgrades',
                'Strategic card decisions every round',
                'Curses with risk-reward trade-offs',
                'Items, kingdom events, and scaling difficulty',
                'Real-time online multiplayer with friends',
                'Competitive 1v1 Duel Mode with card drafting',
                'Achievements, seasons, daily challenges, and leaderboards',
                '3D dice rolling with unlockable dice themes',
            ],
            'modes' => [
                [
                    'name' => 'Co-op Mode',
                    'tag' => '1-6 Players',
                    'description' => 'Work together to keep a shared kingdom alive. Each player picks an advisor and draws their own cards, but everyone pools their dice together when it comes time to roll. Coordinate your card choices, share items, and survive as long as possible against escalating difficulty. One bad month can end it all.',
                    'highlights' => [
                        'Shared kingdom with 6 stats starting at 10',
                        'All players pool dice against combined difficulty',
                        'Difficulty scales every 6 months',
                        'Kingdom events add chaos -- plagues, harvests, and more',
                        'Solo play supported with a single advisor',
                    ],
                ],
                [
                    'name' => 'Duel Mode',
                    'tag' => '1v1',
                    'description' => 'Two rival kingdoms go head-to-head. Draft cards from a shared pool and send the rejects to your opponent. Each player manages their own kingdom of 6 stats, racing to push 3 stats to 20 for domination or survive 24 months with the highest total. Fast, competitive, and ranked.',
                    'highlights' => [
                        'Card drafting -- pick your best, dump the worst on your rival',
                        'Win by domination (3 stats at 20) or highest score at 24 months',
                        'Ranked ladder with ELO rating',
                        'Fast matches -- 10 to 15 minutes',
                        'Play against friends or AI bots',
                    ],
                ],
            ],
            'faq' => [
                [
                    'question' => 'How many players do I need?',
                    'answer' => 'You can play solo with a single advisor in Co-op Mode, or with up to 6 players online. Duel Mode is designed for exactly 2 players -- either against a friend or an AI bot.',
                ],
                [
                    'question' => 'How long does a game take?',
                    'answer' => 'Co-op games typically run 10 to 20 minutes depending on how long you survive and how many players are in the game. Duel Mode matches are fixed at 24 months and usually take around 10 to 15 minutes.',
                ],
                [
                    'question' => 'What are advisor levels?',
                    'answer' => 'Your advisors earn XP from every game. As they level up (1-8), you choose upgrades -- stronger dice faces, extra WILD sides, more item slots, stat bonuses, or score multipliers. Once maxed out, you can immortalise your advisor to reset and keep progressing with a custom name.',
                ],
                [
                    'question' => 'Do I need to download anything?',
                    'answer' => 'No. Trusted Advisors runs entirely in your browser. Just sign in, create or join a room, and start playing. Works on desktop, tablet, and mobile. Native iOS and Android apps are coming soon.',
                ],
                [
                    'question' => 'Is the game pay-to-win?',
                    'answer' => 'No. All cards, characters, items, and gameplay mechanics are available to every player for free. Optional cosmetics like dice themes, kingdom styles, and custom titles can be purchased but give no competitive advantage.',
                ],
                [
                    'question' => 'How does scoring work?',
                    'answer' => 'Your final score is based on your surviving kingdom stats, multiplied by how many years you lasted. Bonus points are awarded for keeping stats balanced, pushing stats above 15, and completing in-game renown events. Items can also modify your final score percentage.',
                ],
                [
                    'question' => 'How do I invite friends?',
                    'answer' => 'Create a room from the main menu and share the room link or code. Friends click the link or enter the code to join -- no friend requests needed. You can also add friends for quick invites and friend-only leaderboards.',
                ],
            ],
            'play_url' => 'https://ta.mpgames.io',
            'logo_url' => 'https://lh3.googleusercontent.com/AnIMEpm5FwolXy1URPHNYfm-bx7CAELLAsV4UzYof54X9NpUCugSNY7l3Oj8CP14YncU6uBTD7f1OnLefBnO',
            'banner_url' => 'https://lh3.googleusercontent.com/Tdg8BATpUSb6MIV88ABJ7zzbOgahD2S0uo1KE38RvRhH7sJCOWaG8KBCyoWBXweBNbbeM1KsgiOhwrdto-EH_Q',
            'screenshots' => [
                'https://lh3.googleusercontent.com/o1NUA0l6MKR5T8CS8x-oYsyf4WXQ1uC2ktnOiN7WuQTprJ2Mtpz8rlY6v_JWAHY9uMl5D7UxCrjQz75MyNMQ',
                'https://lh3.googleusercontent.com/Lmv5Wg9BlPnO6xb6vD32unG7kZVxQxjfYNFlqSxvQyLbuajeb706fSETMPcRU1Wr0wc2S8Zvety4HD1I71gh0Q',
                'https://lh3.googleusercontent.com/3F52UePkZ-j5ZZIYFLLAUwps61kfUt585z5yWL-kQyLDaPkcEhrdyqa6pEwS3oecJ0kLmvQJZSa_COmfP-HHHg',
                'https://lh3.googleusercontent.com/H6Emml-ZCO0HGvCitzECgz93KtFjjp0EcNNRxyr6lmZDL8TbRSCmRPAOBF6zsCVAk7dH9yO_5eK4OswnIGeqbvY',
                'https://lh3.googleusercontent.com/hokML6fKWoX1uRKHLry0oripiu-B8jSfnSbOcXKV2TjB5bsY2wFnqBiaR0sz4xRur_Lyz3wkiE4r9p5LbKun_g',
            ],
            'reviews' => [
                [
                    'name' => 'Alex R.',
                    'rating' => 5,
                    'text' => 'Genuinely addictive. The dice mechanics with unique advisors make every game feel different. My group plays this every weekend now -- the co-op mode is brilliant when you are all trying to keep the kingdom from collapsing.',
                ],
                [
                    'name' => 'Sam K.',
                    'rating' => 5,
                    'text' => 'Duel mode is where this game shines. Drafting cards and dumping bad ones on your opponent is so satisfying. The ranked ladder keeps me coming back -- already climbed to 1400 ELO.',
                ],
                [
                    'name' => 'Jordan T.',
                    'rating' => 4,
                    'text' => 'Love the advisor leveling system. Upgrading dice faces and unlocking new abilities gives you something to work towards between games. Meredith the Shadow is my go-to -- peeking at cards before choosing is so powerful.',
                ],
                [
                    'name' => 'Casey M.',
                    'rating' => 5,
                    'text' => 'The curse system is genius. Taking a permanent penalty for bonus XP is the kind of risk-reward decision that makes this game great. Also the 3D dice rolling is way more fun than it has any right to be.',
                ],
                [
                    'name' => 'Riley P.',
                    'rating' => 4,
                    'text' => 'Perfect for quick sessions. A co-op game takes 15 minutes and duel matches are even faster. Works great on my phone during commutes. The daily challenges keep it fresh.',
                ],
                [
                    'name' => 'Morgan L.',
                    'rating' => 5,
                    'text' => 'My favourite browser game right now. The balance between the six kingdom stats is genuinely tough to manage and the difficulty scaling means you can not just coast. Every month matters.',
                ],
            ],
            'status' => 'published',
            'coming_soon' => false,
            'sort_order' => 1,
        ]);

        Game::updateOrCreate(
            ['slug' => 'dice-wars'],
            [
            'name' => 'Dice Wars',
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

        Game::updateOrCreate(
            ['slug' => 'fantasy-ledger'],
            [
            'name' => 'Fantasy Ledger',
            'short_description' => 'Your fantasy football league\'s complete history. Connect your ESPN league and unlock career stats, records, head-to-head breakdowns, and more.',
            'description' => "Fantasy Ledger preserves and analyzes your fantasy football league's entire history. Connect your ESPN league and instantly unlock detailed stats, records, head-to-head breakdowns, draft history, and season replays -- spanning every season your league has played.\n\nTurn years of league data into compelling stories, settle rivalries with real numbers, and discover records you never knew existed.",
            'long_description' => "Fantasy Ledger connects directly to ESPN's Fantasy Football API to sync your league's complete history -- every season, every matchup, every draft pick. Once connected, the platform builds a comprehensive record book for your league that goes far beyond what ESPN provides.\n\nCareer Stats show all-time standings, win percentages, and points-for rankings so you can see who really is the best manager across all seasons. The Record Book captures the highest scores, biggest blowouts, closest games, and the best and worst seasons in league history.\n\nHead-to-Head comparisons let you pit any two owners against each other across every matchup they have ever played -- perfect for settling rivalries and finding your true nemesis. Draft History tracks every pick from every draft, revealing who reached, who stole sleepers, and who busted.\n\nSeason Replay lets you relive any past season week by week with standings races, awards, and playoff brackets. And for the less fortunate managers, the Loser Cup tracks repeat offenders and the worst performances in league history.\n\nWhether your league has been running for 3 years or 20, Fantasy Ledger turns your raw data into a living archive of rivalries, glory, and shame.",
            'features' => [
                'Career stats with all-time standings and win percentages',
                'Record book for highest scores, blowouts, and closest games',
                'Head-to-head comparisons across all matchups',
                'Complete draft history for every season',
                'Season replay with standings races and playoff brackets',
                'Loser Cup hall of shame',
                'Power rankings and visualizations',
                'ESPN league sync -- connect once, stats update automatically',
            ],
            'modes' => [
                [
                    'name' => 'League Dashboard',
                    'tag' => 'Overview',
                    'description' => 'Your league at a glance. See current standings, recent results, and key stats all in one place. The dashboard updates automatically as your ESPN league progresses through the season.',
                    'highlights' => [
                        'All-time standings and career arcs',
                        'Current season overview',
                        'Quick access to records and head-to-head tools',
                    ],
                ],
                [
                    'name' => 'Record Book',
                    'tag' => 'All-Time',
                    'description' => 'Every notable achievement and record in your league\'s history. From the highest single-week score to the longest win streak, the Record Book captures it all.',
                    'highlights' => [
                        'Highest and lowest scores of all time',
                        'Biggest blowouts and closest finishes',
                        'Best and worst seasons by any owner',
                    ],
                ],
            ],
            'faq' => [
                [
                    'question' => 'Which fantasy platforms are supported?',
                    'answer' => 'Fantasy Ledger currently supports ESPN Fantasy Football leagues. Support for other platforms is being explored.',
                ],
                [
                    'question' => 'How far back does it go?',
                    'answer' => 'Fantasy Ledger syncs your league\'s entire available history from ESPN. If ESPN has the data, Fantasy Ledger will pull it in.',
                ],
                [
                    'question' => 'Is my league data private?',
                    'answer' => 'You control your league\'s visibility. Leagues can be set to public or private, and only invited members can access private league data.',
                ],
                [
                    'question' => 'Do I need to download anything?',
                    'answer' => 'No. Fantasy Ledger runs entirely in your browser. Just sign in, connect your ESPN league, and start exploring your history.',
                ],
            ],
            'play_url' => 'https://fantasyledger.io',
            'logo_url' => 'https://fantasyledger.io/images/logo.png',
            'banner_url' => null,
            'screenshots' => [],
            'reviews' => [],
            'status' => 'published',
            'coming_soon' => false,
            'sort_order' => 3,
        ]);

        Page::updateOrCreate(
            ['slug' => 'privacy-policy'],
            [
            'title' => 'Privacy Policy',
            'content' => "*Last updated: March 5, 2026*\n\nMPGames (\"we\", \"us\", or \"our\") provides multiplayer gaming services through our website and games (collectively, the \"Service\"). This Privacy Policy explains how we collect, use, disclose, and protect your personal data when you use the Service. By using the Service, you agree to the collection and use of information in accordance with this policy.\n\n---\n\n## 1. Contact Us\n\nIf you have questions about data protection or wish to exercise your privacy rights, you can contact us at:\n\n**Email:** legal@mpgames.io\n\nFor general player support or in-game issues, please use the support features available within our games for faster assistance.\n\n## 2. The Data We Collect\n\n### Data you provide directly\n\n- Contact information such as your name and email address when you create an account\n- Player profile information such as your username and avatar\n- Messages and communications you send through the Service, including in-game chat, support tickets, and feedback\n- Information you provide when participating in surveys, competitions, or promotions\n- Payment and transaction information when you make purchases (payment processing is handled by third-party providers; we do not store your full payment card details)\n\n### Data we collect automatically\n\n- Game progress, scores, achievements, and gameplay statistics\n- Your IP address and approximate location (country or region level)\n- Device information such as device type, operating system, browser type, and screen resolution\n- Unique device identifiers and account identifiers\n- Log data such as access times, pages viewed, and referring URLs\n- Cookies and similar tracking technologies (see Section 7 below)\n\n### Data we receive from third parties\n\n- If you log in using a third-party service (such as Google or other social platforms), we may receive your name, email address, and profile information as permitted by that service\n- Fraud prevention and security data from third-party services\n\n## 3. Why We Collect Your Data\n\n**To operate and provide the Service:**\n\n- Create and manage your account\n- Process transactions and payments\n- Enable multiplayer gameplay and matchmaking\n- Provide player support and respond to your requests\n- Send you service-related communications such as updates, security alerts, and support messages\n\n**To improve and develop the Service:**\n\n- Understand how players use our games so we can improve them\n- Develop new features, games, and services\n- Conduct analytics and research\n- Personalise your experience\n\n**To keep the Service safe and fair:**\n\n- Detect, investigate, and prevent fraud, cheating, and unauthorised activity\n- Monitor and moderate chat and user-generated content\n- Enforce our Terms & Conditions and game rules\n- Comply with legal obligations\n\n**With your consent:**\n\n- Send you promotional communications about our games and services (you can opt out at any time)\n\n## 4. Who We Share Your Data With\n\n**Other players:** Other players can see your in-game profile, username, gameplay activity, and any content you share publicly through the Service.\n\n**Service providers:** We work with third-party companies that help us operate, maintain, and improve the Service. These include hosting providers, analytics services, payment processors, and customer support tools. These providers only have access to your data as needed to perform their services and are contractually obligated to protect it.\n\n**Payment providers:** When you make a purchase, your payment is processed by third-party payment providers. We do not have access to your full payment card details.\n\n**Legal and safety:** We may disclose your data if required to do so by law or if we believe in good faith that such action is necessary to comply with legal obligations, protect our rights or the safety of our players, or investigate potential violations of our Terms & Conditions.\n\n**Business transfers:** If MPGames is involved in a merger, acquisition, or sale of assets, your data may be transferred as part of that transaction. We will notify you of any such change.\n\n## 5. International Data Transfers\n\nYour data may be transferred to and processed in countries other than the country in which you reside. These countries may have data protection laws that differ from the laws of your country. When we transfer data internationally, we take appropriate safeguards to ensure your data remains protected, including the use of standard contractual clauses approved by relevant authorities.\n\n## 6. Your Rights and Options\n\nDepending on your location, you may have the following rights regarding your personal data:\n\n- **Access:** You can request a copy of the personal data we hold about you.\n- **Correction:** You can request that we correct inaccurate or incomplete personal data.\n- **Deletion:** You can request that we delete your personal data. Please note that we may need to retain certain data for legal or legitimate business purposes.\n- **Data portability:** You can request to receive your personal data in a structured, commonly used, and machine-readable format.\n- **Objection and restriction:** You can object to or request restriction of certain processing of your personal data.\n- **Withdraw consent:** Where we rely on your consent to process personal data, you can withdraw your consent at any time.\n- **Promotional communications:** You can opt out of receiving promotional emails by following the unsubscribe instructions in those messages.\n\nTo exercise any of these rights, please contact us at **legal@mpgames.io**. We will respond to your request within a reasonable timeframe and in accordance with applicable law.\n\n## 7. Cookies and Similar Technologies\n\nWe use cookies and similar technologies to:\n\n- Remember your preferences and settings\n- Authenticate your identity and keep your session secure\n- Analyse how our Service is used so we can improve it\n- Prevent fraud and enhance security\n\nYou can manage your cookie preferences through your browser settings. Please note that disabling cookies may affect the functionality of the Service.\n\nWe may use the following types of third-party services:\n\n- Analytics services (such as Google Analytics) to help us understand usage patterns\n- Authentication services to enable third-party login\n\n## 8. How We Protect Your Data\n\n**Security measures:** We implement appropriate technical, administrative, and organisational measures to protect your personal data against unauthorised access, alteration, disclosure, or destruction. These measures are regularly reviewed and updated.\n\n**Data retention:** We retain your personal data for as long as your account is active or as needed to provide you with the Service. If your account is inactive for an extended period, we may de-identify or delete your data. We may retain certain data for longer periods where required by law or for legitimate business purposes such as fraud prevention.\n\n## 9. Children\n\nOur Service is not directed at children under the age of 13. We do not knowingly collect personal data from children under 13. If we become aware that we have collected personal data from a child under 13 without parental consent, we will take steps to delete that information. If you believe we have collected data from a child under 13, please contact us at **legal@mpgames.io**.\n\nFor players between the ages of 13 and 18 (or the applicable age of majority in your jurisdiction), we may restrict access to certain features such as chat and social functionality.\n\n## 10. Changes to This Privacy Policy\n\nWe may update this Privacy Policy from time to time. When we make material changes, we will notify you by posting the updated policy on our website and updating the \"Last updated\" date above. We encourage you to review this Privacy Policy periodically to stay informed about how we protect your data.\n\n## 11. Additional Disclosures for Specific Regions\n\n**European Economic Area (EEA), United Kingdom, and Switzerland:** If you are located in the EEA, UK, or Switzerland, we process your personal data on the following legal bases: performance of a contract (to provide the Service), legitimate interests (to improve and secure the Service), compliance with legal obligations, and your consent (where applicable). You have the right to lodge a complaint with your local data protection authority.\n\n**United States:** If you are a resident of California, Colorado, Connecticut, Virginia, or other US states with comprehensive privacy laws, you may have additional rights including the right to know what personal data we collect, the right to delete your data, and the right to opt out of certain data sharing. We do not sell your personal data. To exercise your rights, please contact us at **legal@mpgames.io**.",
        ]);

        Page::updateOrCreate(
            ['slug' => 'terms-and-conditions'],
            [
            'title' => 'Terms & Conditions',
            'content' => "*Last updated: January 1, 2025*\n\n---\n\n## 1. Acceptance of Terms\n\nBy accessing and using MPGames services, you agree to be bound by these Terms and Conditions.\n\n## 2. Use of Services\n\nYou agree to use our services only for lawful purposes and in accordance with these Terms. You agree not to:\n\n- Use the services in any way that violates any applicable law or regulation\n- Engage in any conduct that restricts or inhibits anyone's use of the services\n- Attempt to gain unauthorized access to any part of the services\n\n## 3. Accounts\n\nWhen you create an account, you must provide accurate and complete information. You are responsible for maintaining the confidentiality of your account credentials.\n\n## 4. Intellectual Property\n\nThe services and their original content, features, and functionality are owned by MPGames and are protected by international copyright, trademark, and other intellectual property laws.\n\n## 5. Limitation of Liability\n\nIn no event shall MPGames be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of the services.\n\n## 6. Contact Us\n\nIf you have any questions about these Terms, please contact us at **legal@mpgames.io**.",
        ]);
    }
}
