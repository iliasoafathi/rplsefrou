<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', 'RPL Sefrou - Votre source d\'information locale')</title>
    <meta name="description" content="@yield('description', 'RPL Sefrou - Votre source d\'information locale pour Sefrou et sa région. Actualités, activités et informations importantes.')">
    <meta name="keywords" content="RPL Sefrou, actualités Sefrou, activités Sefrou, informations locales, Maroc">
    <meta name="keywords" content="شبكة تنمية القراءة بصفرو, صفرو, activités Sefrou, informations locales, Maroc">
    <meta name="author" content="RPL Sefrou, شبكة تنمية القراءة بصفرو">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'RPL Sefrou - Votre source d\'information locale')">
    <meta property="og:description" content="@yield('description', 'RPL Sefrou - Votre source d\'information locale pour Sefrou et sa région.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:site_name" content="RPL Sefrou">
    <meta property="og:locale" content="fr_FR">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'RPL Sefrou')">
    <meta name="twitter:description" content="@yield('description', 'Votre source d\'information locale pour Sefrou et sa région.')">
    <meta name="twitter:image" content="{{ asset('images/twitter-image.jpg') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'dark': '#333533',
                            'darker': '#242423',
                            'gold': '#F5CB5C',
                            'light': '#E8EDDF',
                            'mint': '#CFDBD5'
                        },
                        fontFamily: {
                            'sans': ['Inter', 'system-ui', 'sans-serif']
                        },
                        animation: {
                            'float': 'float 6s ease-in-out infinite',
                            'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                            'bounce-in': 'bounceIn 1s ease-out',
                            'slide-up': 'slideUp 0.8s ease-out',
                            'fade-in': 'fadeIn 0.6s ease-out'
                        },
                        keyframes: {
                            float: {
                                '0%, 100%': { transform: 'translateY(0px)' },
                                '50%': { transform: 'translateY(-20px)' }
                            },
                            bounceIn: {
                                '0%': { transform: 'scale(0.3)', opacity: '0' },
                                '50%': { transform: 'scale(1.05)' },
                                '70%': { transform: 'scale(0.9)' },
                                '100%': { transform: 'scale(1)', opacity: '1' }
                            },
                            slideUp: {
                                '0%': { transform: 'translateY(30px)', opacity: '0' },
                                '100%': { transform: 'translateY(0)', opacity: '1' }
                            },
                            fadeIn: {
                                '0%': { opacity: '0' },
                                '100%': { opacity: '1' }
                            }
                        }
                    }
                }
            }
        </script>
    @endif

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #242423 0%, #333533 50%, #242423 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #F5CB5C 0%, #E8EDDF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .loading {
            position: relative;
            overflow: hidden;
        }
        
        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #E8EDDF;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #F5CB5C;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #E8EDDF;
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased bg-light text-dark">
    <!-- Modern Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-darker/95 backdrop-blur-md shadow-2xl border-b border-gold/20 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo with animation -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <div class="relative mr-3">
                            <div class="absolute inset-0 bg-gold rounded-full blur-lg opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                            <img src="{{ asset('rpl_logo.jpg') }}" alt="RPL Sefrou" class="relative w-10 h-10 rounded-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-gold to-yellow-400 bg-clip-text text-transparent group-hover:scale-105 transition-transform duration-300">
                            شبكة تنمية القراءة بصفرو
                        </h1>
                    </a>
                </div>

                <!-- Desktop Navigation with hover effects -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="nav-link group relative px-4 py-2 text-sm font-medium text-light hover:text-gold transition-all duration-300">
                        <span class="relative z-10">Accueil</span>
                        <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-gold to-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    <a href="{{ route('articles.index') }}" class="nav-link group relative px-4 py-2 text-sm font-medium text-light hover:text-gold transition-all duration-300">
                        <span class="relative z-10">Articles</span>
                        <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-gold to-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    <a href="{{ route('activities.index') }}" class="nav-link group relative px-4 py-2 text-sm font-medium text-light hover:text-gold transition-all duration-300">
                        <span class="relative z-10">Activités</span>
                        <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-gold to-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    <a href="{{ route('members.index') }}" class="nav-link group relative px-4 py-2 text-sm font-medium text-light hover:text-gold transition-all duration-300">
                        <span class="relative z-10">Membres</span>
                        <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-gold to-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    <a href="{{ route('contact') }}" class="nav-link group relative px-4 py-2 text-sm font-medium text-light hover:text-gold transition-all duration-300">
                        <span class="relative z-10">Contact</span>
                        <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-gold to-yellow-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                </div>

                <!-- Modern Search Bar -->
                <div class="hidden lg:flex items-center">
                    <div class="relative group">
                        <form action="{{ route('search') }}" method="GET" class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-gold/20 to-yellow-400/20 rounded-xl blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <input type="text" name="q" placeholder="Rechercher..." 
                                   value="{{ request('q') }}"
                                   class="relative w-64 px-4 py-2 pl-10 pr-4 text-sm text-dark bg-light/90 backdrop-blur-sm border border-mint/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold focus:bg-light transition-all duration-300 placeholder:text-dark/60">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-dark/60 group-hover:text-gold transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modern Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button type="button" class="mobile-menu-btn relative p-2 text-light hover:text-gold focus:outline-none transition-all duration-300" id="mobile-menu-button">
                        <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 hover:scale-100 transition-transform duration-300"></div>
                        <svg class="relative h-6 w-6 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modern Mobile Navigation -->
        <div class="lg:hidden fixed inset-x-0 top-20 bg-darker/98 backdrop-blur-xl border-t border-gold/20 transform -translate-y-full transition-transform duration-300 ease-in-out" id="mobile-menu">
            <div class="px-4 py-6 space-y-2">
                <!-- Mobile Search -->
                <div class="mb-6">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-gold/10 to-yellow-400/10 rounded-xl blur-sm"></div>
                        <input type="text" name="q" placeholder="Rechercher..." 
                               value="{{ request('q') }}"
                               class="relative w-full px-4 py-3 pl-10 pr-4 text-sm text-dark bg-light/90 backdrop-blur-sm border border-mint/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-dark/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </form>
                </div>
                
                <!-- Mobile Navigation Links -->
                <a href="{{ route('home') }}" class="mobile-nav-link group flex items-center px-4 py-3 text-base font-medium text-light hover:text-gold transition-all duration-300 rounded-lg hover:bg-gold/10">
                    <span class="relative z-10">Accueil</span>
                    <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                </a>
                <a href="{{ route('articles.index') }}" class="mobile-nav-link group flex items-center px-4 py-3 text-base font-medium text-light hover:text-gold transition-all duration-300 rounded-lg hover:bg-gold/10">
                    <span class="relative z-10">Articles</span>
                    <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                </a>
                <a href="{{ route('activities.index') }}" class="mobile-nav-link group flex items-center px-4 py-3 text-base font-medium text-light hover:text-gold transition-all duration-300 rounded-lg hover:bg-gold/10">
                    <span class="relative z-10">Activités</span>
                    <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                </a>
                <a href="{{ route('members.index') }}" class="mobile-nav-link group flex items-center px-4 py-3 text-base font-medium text-light hover:text-gold transition-all duration-300 rounded-lg hover:bg-gold/10">
                    <span class="relative z-10">Membres</span>
                    <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                </a>
                <a href="{{ route('contact') }}" class="mobile-nav-link group flex items-center px-4 py-3 text-base font-medium text-light hover:text-gold transition-all duration-300 rounded-lg hover:bg-gold/10">
                    <span class="relative z-10">Contact</span>
                    <div class="absolute inset-0 bg-gold/10 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                </a>
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed navbar -->
    <div class="h-20"></div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Newsletter -->
    @include('components.newsletter')

    <!-- Footer -->
    <footer class="bg-darker text-light border-t border-gold">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Logo and Description -->
                <div class="lg:col-span-2">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('rpl_logo.jpg') }}" alt="RPL Sefrou" class="w-10 h-10 rounded-full object-cover mr-3">
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-gold to-yellow-400 bg-clip-text text-transparent">
                            RPL Sefrou
                        </h3>
                    </div>
                    <p class="text-light/80 mb-6 max-w-md">
                        Votre réseau pour la lecture à Sefrou et sa région. Actualités, activités et informations importantes.
                    </p>
                    <!-- Social Media Links -->
                    <div class="flex space-x-4">
                        <a href="#" class="group relative p-2 bg-gold/10 rounded-lg hover:bg-gold/20 transition-all duration-300">
                            <div class="absolute inset-0 bg-gold/20 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                            <svg class="relative w-5 h-5 text-gold group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="group relative p-2 bg-gold/10 rounded-lg hover:bg-gold/20 transition-all duration-300">
                            <div class="absolute inset-0 bg-gold/20 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                            <svg class="relative w-5 h-5 text-gold group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="group relative p-2 bg-gold/10 rounded-lg hover:bg-gold/20 transition-all duration-300">
                            <div class="absolute inset-0 bg-gold/20 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                            <svg class="relative w-5 h-5 text-gold group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gold">Liens Rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-light/80 hover:text-gold transition-colors duration-300">Accueil</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-light/80 hover:text-gold transition-colors duration-300">Articles</a></li>
                        <li><a href="{{ route('activities.index') }}" class="text-light/80 hover:text-gold transition-colors duration-300">Activités</a></li>
                        <li><a href="{{ route('members.index') }}" class="text-light/80 hover:text-gold transition-colors duration-300">Membres</a></li>
                        <li><a href="{{ route('contact') }}" class="text-light/80 hover:text-gold transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gold">Contact</h4>
                    <div class="space-y-2 text-light/80">
                        <p>📍 Sefrou, Maroc</p>
                        <p>📧 contact@rplsefrou.ma</p>
                        <p>📞 +212 XXX XXX XXX</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gold/20 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-light/60 text-sm">
                    © {{ date('Y') }} RPL Sefrou. Tous droits réservés.
                </p>
                
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- Modern JavaScript for Interactions -->
    <script>
        // Mobile menu toggle with smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const navbar = document.getElementById('navbar');
            
            // Mobile menu toggle
            mobileMenuButton.addEventListener('click', function() {
                const isOpen = mobileMenu.classList.contains('translate-y-0');
                
                if (isOpen) {
                    mobileMenu.classList.remove('translate-y-0');
                    mobileMenu.classList.add('-translate-y-full');
                    mobileMenuButton.querySelector('svg').style.transform = 'rotate(0deg)';
                } else {
                    mobileMenu.classList.remove('-translate-y-full');
                    mobileMenu.classList.add('translate-y-0');
                    mobileMenuButton.querySelector('svg').style.transform = 'rotate(90deg)';
                }
            });

            // Navbar scroll effect
            let lastScrollY = window.scrollY;
            window.addEventListener('scroll', function() {
                const currentScrollY = window.scrollY;
                
                if (currentScrollY > 100) {
                    navbar.classList.add('bg-darker/98', 'shadow-2xl');
                    navbar.classList.remove('bg-darker/95');
                } else {
                    navbar.classList.remove('bg-darker/98', 'shadow-2xl');
                    navbar.classList.add('bg-darker/95');
                }
                
                // Hide/show navbar on scroll
                if (currentScrollY > lastScrollY && currentScrollY > 200) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }
                
                lastScrollY = currentScrollY;
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add loading animation to buttons
            document.querySelectorAll('button[type="submit"]').forEach(button => {
                button.addEventListener('click', function() {
                    if (this.form && this.form.checkValidity()) {
                        this.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 150);
                    }
                });
            });

            // Parallax effect for hero sections
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.parallax');
                
                parallaxElements.forEach(element => {
                    const speed = element.dataset.speed || 0.5;
                    element.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });

            // Intersection Observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, observerOptions);

            // Observe elements for animation
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });

            // Add ripple effect to buttons
            document.querySelectorAll('.ripple-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });

        // Copy to clipboard function
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show success message
                const button = event.target.closest('button');
                const originalContent = button.innerHTML;
                button.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                button.classList.add('bg-green-500', 'hover:bg-green-600');
                button.classList.remove('bg-dark', 'hover:bg-gold');
                
                setTimeout(() => {
                    button.innerHTML = originalContent;
                    button.classList.remove('bg-green-500', 'hover:bg-green-600');
                    button.classList.add('bg-dark', 'hover:bg-gold');
                }, 2000);
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>