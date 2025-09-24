@extends('layouts.app')

@section('title', 'Articles - شبكة تنمية القراءة بصفرو')
@section('description', 'Découvrez tous nos articles sur Sefrou et sa région.')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-bounce-in">
                Articles
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90 animate-slide-up">
                Découvrez les dernières actualités et informations sur Sefrou et sa région
            </p>
        </div>
    </div>
    <!-- Animated background elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-gold opacity-10 rounded-full animate-bounce"></div>
    <div class="absolute bottom-20 right-10 w-16 h-16 bg-gold opacity-10 rounded-full animate-pulse"></div>
    <div class="absolute top-1/2 left-1/4 w-12 h-12 bg-mint opacity-20 rounded-full animate-pulse-slow"></div>
</section>

<!-- Articles Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-4">
        <!-- Filters/Search -->
        <form method="GET" class="bg-white rounded-xl shadow-lg p-4 mb-8 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm text-dark/70 mb-1">Rechercher</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Titre, contenu..." class="w-full px-3 py-2 border border-gold rounded-lg focus:ring-gold focus:border-gold">
            </div>
            <div>
                <label class="block text-sm text-dark/70 mb-1">Publié après</label>
                <input type="date" name="from" value="{{ request('from') }}" class="w-full px-3 py-2 border border-gold rounded-lg focus:ring-gold focus:border-gold">
            </div>
            <div>
                <label class="block text-sm text-dark/70 mb-1">Publié avant</label>
                <div class="flex gap-2">
                    <input type="date" name="to" value="{{ request('to') }}" class="w-full px-3 py-2 border border-gold rounded-lg focus:ring-gold focus:border-gold">
                    <button class="px-4 py-2 bg-gold text-dark rounded-lg font-medium">Filtrer</button>
                </div>
            </div>
        </form>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 animate-on-scroll group">
                    @if($article->cover_image_path)
                        <div class="relative overflow-hidden">
                            <img src="{{ Storage::url($article->cover_image_path) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                        </div>
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-gold to-yellow-400 flex items-center justify-center">
                            <span class="text-dark text-lg font-semibold">شبكة تنمية القراءة بصفرو</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center text-sm text-dark/60 mb-2">
                            @if($article->published_at)
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $article->published_at ? $article->published_at->format('d/m/Y') : $article->created_at->format('d/m/Y') }}</span>
                            @endif
                            <span class="mx-2">•</span>
                            <span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs">Article</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-dark group-hover:text-gold transition-colors line-clamp-2">
                            {{ $article->title }}
                        </h3>
                        @if($article->excerpt)
                            <p class="text-dark/70 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                        @endif
                        <a href="{{ route('articles.show', $article->slug) }}" class="group inline-flex items-center bg-gold text-dark px-4 py-2 rounded-lg font-medium hover:bg-yellow-400 transition-all duration-300 transform hover:scale-105">
                            <span>Lire plus</span>
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 animate-on-scroll">
                    <div class="text-6xl mb-4 animate-bounce">📝</div>
                    <h3 class="text-2xl font-semibold text-dark/70 mb-2">Aucun article disponible</h3>
                    <p class="text-dark/50">Il n'y a pas encore d'articles publiés. Revenez bientôt pour découvrir nos contenus.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="mt-12 flex justify-center">
            <div class="bg-white rounded-xl shadow-lg p-4">
                {{ $articles->links() }}
            </div>
        </div>
        @endif
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
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Animation pour les images au hover */
    .group:hover img {
        transform: scale(1.1);
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