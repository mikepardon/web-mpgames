<template>
    <div class="relative min-h-screen overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-surface">
            <div class="absolute inset-0 bg-grid opacity-30"></div>
            <div class="absolute top-1/4 right-1/4 w-[400px] h-[400px] bg-primary/5 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-1/4 left-1/4 w-[300px] h-[300px] bg-accent/5 rounded-full blur-[100px]"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-sm font-semibold text-accent uppercase tracking-widest mb-4">Get In Touch</h2>
                <h1 class="text-4xl sm:text-6xl font-black text-white mb-6">
                    Let's <span class="gradient-text">Talk</span>
                </h1>
                <p class="text-lg text-gray-400 max-w-xl mx-auto">
                    Have a question, feedback on a game, or just want to say hi?
                    We'd love to hear from you.
                </p>
            </div>

            <!-- Contact Cards -->
            <div class="grid sm:grid-cols-2 gap-6 max-w-2xl mx-auto">
                <!-- Email -->
                <a
                    href="mailto:contact@mpgames.io"
                    class="group glass rounded-2xl p-8 hover:bg-white/[0.04] transition-all duration-300 text-center"
                >
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary/20 to-primary/5 border border-primary/20 flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Email Us</h3>
                    <p class="text-primary-light font-medium">contact@mpgames.io</p>
                    <p class="text-sm text-gray-500 mt-2">We typically respond within 24 hours</p>
                </a>

                <!-- Web -->
                <div class="group glass rounded-2xl p-8 hover:bg-white/[0.04] transition-all duration-300 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-accent/20 to-accent/5 border border-accent/20 flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-accent-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Website</h3>
                    <p class="text-accent-light font-medium">mpgames.io</p>
                    <p class="text-sm text-gray-500 mt-2">Check out our latest games and updates</p>
                </div>
            </div>

            <!-- FAQ / Info -->
            <div class="mt-16 glass rounded-2xl p-8 max-w-2xl mx-auto">
                <h3 class="text-xl font-bold text-white mb-6 text-center">Common Questions</h3>
                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold text-white mb-2">Are your games really free?</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">Yes, all our games are free to play. There are optional add-ons that can be purchased, but the full core experience is completely free with no pay-to-win mechanics.</p>
                    </div>
                    <div class="section-divider"></div>
                    <div>
                        <h4 class="font-semibold text-white mb-2">Do I need to create an account?</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">Yes, you'll need to create a free account at auth.mpgames.io. It only takes a few seconds, and then you're ready to play all our games.</p>
                    </div>
                    <div class="section-divider"></div>
                    <div>
                        <h4 class="font-semibold text-white mb-2">Can I suggest a game idea?</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">Absolutely! We love hearing from players. Send your ideas to our email and we'll take a look.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>