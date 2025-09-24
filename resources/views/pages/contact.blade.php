@extends('layouts.app')

@section('title', 'Contact - RPL Sefrou')
@section('description', 'Contactez RPL Sefrou pour toute question ou suggestion.')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-bounce-in">
                Contactez-nous
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90 animate-slide-up">
                Vous avez des questions, des suggestions ou souhaitez contribuer à notre contenu ?
            </p>
        </div>
    </div>
    <!-- Animated background elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-gold opacity-10 rounded-full animate-bounce"></div>
    <div class="absolute bottom-20 right-10 w-16 h-16 bg-gold opacity-10 rounded-full animate-pulse"></div>
    <div class="absolute top-1/2 left-1/4 w-12 h-12 bg-mint opacity-20 rounded-full animate-pulse-slow"></div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-4">
        @if(session('success'))
        <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg animate-on-scroll">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8 animate-on-scroll">
                <h2 class="text-3xl font-bold text-dark mb-6">Envoyez-nous un message</h2>
                
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-dark mb-2">Prénom</label>
                            <input type="text" id="first_name" name="first_name" required 
                                   value="{{ old('first_name') }}"
                                   class="w-full px-4 py-3 border border-mint/50 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold transition-all duration-300 bg-light/50">
                            @error('first_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-dark mb-2">Nom</label>
                            <input type="text" id="last_name" name="last_name" required 
                                   value="{{ old('last_name') }}"
                                   class="w-full px-4 py-3 border border-mint/50 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold transition-all duration-300 bg-light/50">
                            @error('last_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-dark mb-2">Email</label>
                        <input type="email" id="email" name="email" required 
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-mint/50 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold transition-all duration-300 bg-light/50">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-dark mb-2">Sujet</label>
                        <input type="text" id="subject" name="subject" required 
                               value="{{ old('subject') }}"
                               class="w-full px-4 py-3 border border-mint/50 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold transition-all duration-300 bg-light/50">
                        @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-dark mb-2">Message</label>
                        <textarea id="message" name="message" rows="6" required 
                                  class="w-full px-4 py-3 border border-mint/50 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold transition-all duration-300 bg-light/50 resize-none">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-gold to-yellow-400 text-dark py-3 px-6 rounded-xl hover:from-yellow-400 hover:to-gold focus:outline-none focus:ring-2 focus:ring-gold focus:ring-offset-2 transition-all duration-300 font-semibold transform hover:scale-105 ripple-btn">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Envoyer le message
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8 animate-on-scroll">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold text-dark mb-6">Informations de contact</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start group">
                            <div class="flex-shrink-0 bg-gold/10 p-3 rounded-xl group-hover:bg-gold/20 transition-colors duration-300">
                                <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-dark">Adresse</h3>
                                <p class="text-dark/70">Sefrou, Maroc</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start group">
                            <div class="flex-shrink-0 bg-gold/10 p-3 rounded-xl group-hover:bg-gold/20 transition-colors duration-300">
                                <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-dark">Email</h3>
                                <p class="text-dark/70">contact@rplsefrou.ma</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start group">
                            <div class="flex-shrink-0 bg-gold/10 p-3 rounded-xl group-hover:bg-gold/20 transition-colors duration-300">
                                <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-dark">Horaires</h3>
                                <p class="text-dark/70">Lundi - Vendredi: 9h00 - 17h00</p>
                                <p class="text-dark/70">Samedi: 9h00 - 13h00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Static Page Content -->
                @if($page && $page->content)
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="prose prose-sm max-w-none prose-headings:text-dark prose-p:text-dark/70 prose-a:text-gold">
                        {!! $page->content !!}
                    </div>
                </div>
                @endif

                <!-- Social Media -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-xl font-semibold text-dark mb-6">Suivez-nous</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="group relative p-3 bg-gold/10 rounded-xl hover:bg-gold/20 transition-all duration-300">
                            <div class="absolute inset-0 bg-gold/20 rounded-xl scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                            <svg class="relative w-6 h-6 text-gold group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="group relative p-3 bg-gold/10 rounded-xl hover:bg-gold/20 transition-all duration-300">
                            <div class="absolute inset-0 bg-gold/20 rounded-xl scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                            <svg class="relative w-6 h-6 text-gold group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="group relative p-3 bg-gold/10 rounded-xl hover:bg-gold/20 transition-all duration-300">
                            <div class="absolute inset-0 bg-gold/20 rounded-xl scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                            <svg class="relative w-6 h-6 text-gold group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Animations personnalisées */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .animate-on-scroll.animate-fade-in {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Smooth transitions pour tous les éléments */
    * {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
</style>

<script>
    // Animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
</script>
@endsection