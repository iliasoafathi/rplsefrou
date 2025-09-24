@extends('layouts.app')

@section('title', $article->title . ' - RPL Sefrou')
@section('description', $article->excerpt ?: 'Découvrez cet article sur RPL Sefrou.')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-bounce-in">
                {{ $article->title }}
            </h1>
            @if($article->excerpt)
                <p class="text-xl md:text-2xl mb-8 opacity-90 animate-slide-up">
                    {{ $article->excerpt }}
                </p>
            @endif
            <div class="flex items-center justify-center text-light/80 animate-fade-in">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>
    <!-- Animated background elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-gold opacity-10 rounded-full animate-bounce"></div>
    <div class="absolute bottom-20 right-10 w-16 h-16 bg-gold opacity-10 rounded-full animate-pulse"></div>
</section>

<!-- Breadcrumb -->
<section class="bg-light py-4">
    <div class="container mx-auto px-4">
        <nav class="animate-on-scroll">
            <ol class="flex items-center space-x-2 text-sm text-dark/60">
                <li><a href="{{ route('home') }}" class="hover:text-gold transition-colors duration-300">Accueil</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('articles.index') }}" class="hover:text-gold transition-colors duration-300">Articles</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-dark">{{ Str::limit($article->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Article Content -->
<article class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Article Cover Image -->
        @if($article->cover_image_path)
        <div class="mb-12 animate-on-scroll">
            <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                <img src="{{ Storage::url($article->cover_image_path) }}" alt="{{ $article->title }}" class="w-full h-64 md:h-96 object-cover transform hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
        </div>
        @endif

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none animate-on-scroll">
            <div class="prose-headings:text-dark prose-headings:font-bold prose-p:text-dark/80 prose-p:leading-relaxed prose-a:text-gold prose-a:no-underline hover:prose-a:underline prose-strong:text-dark prose-blockquote:border-l-gold prose-blockquote:bg-gold/5 prose-blockquote:pl-6 prose-blockquote:py-4 prose-blockquote:rounded-r-lg">
                {!! $article->content !!}
            </div>
        </div>

        <!-- Article Footer -->
        <div class="mt-12 pt-8 border-t border-light animate-on-scroll">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div class="mb-4 sm:mb-0">
                    <p class="text-sm text-dark/60">
                        Publié le {{ $article->published_at ? $article->published_at->format('d M Y à H:i') : $article->created_at->format('d M Y à H:i') }}
                    </p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('articles.index') }}" class="group inline-flex items-center bg-dark text-gold px-6 py-3 rounded-lg font-semibold hover:bg-darker transition-all duration-300 transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour aux articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Related Articles -->
@if($relatedArticles->count() > 0)
<section class="py-16 bg-light">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-dark animate-on-scroll">Articles connexes</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedArticles as $relatedArticle)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-on-scroll group">
                    @if($relatedArticle->cover_image_path)
                        <div class="relative overflow-hidden">
                            <img src="{{ Storage::url($relatedArticle->cover_image_path) }}" alt="{{ $relatedArticle->title }}" class="w-full h-32 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                        </div>
                    @else
                        <div class="w-full h-32 bg-gradient-to-br from-gold to-yellow-400 flex items-center justify-center">
                            <span class="text-dark text-sm font-semibold">RPL Sefrou</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <div class="flex items-center text-xs text-dark/60 mb-2">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $relatedArticle->published_at ? $relatedArticle->published_at->format('d M Y') : $relatedArticle->created_at->format('d M Y') }}</span>
                        </div>
                        <h3 class="text-sm font-semibold text-dark mb-2 line-clamp-2 group-hover:text-gold transition-colors">
                            <a href="{{ route('articles.show', $relatedArticle->slug) }}">
                                {{ $relatedArticle->title }}
                            </a>
                        </h3>
                        @if($relatedArticle->excerpt)
                            <p class="text-xs text-dark/70 line-clamp-2">{{ $relatedArticle->excerpt }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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