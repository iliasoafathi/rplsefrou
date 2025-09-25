@extends('layouts.app')

@section('title', 'Activités - شبكة تنمية القراءة بصفرو')
@section('description', 'Découvrez toutes les activités et événements organisés à Sefrou.')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-bounce-in">
                Activités
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90 animate-slide-up">
                Participez aux événements et activités organisés dans notre région
            </p>
            <div class="flex justify-center gap-3">
                <a href="{{ route('activities.completed') }}" class="inline-flex items-center bg-mint text-dark px-4 py-2 rounded-lg font-medium hover:bg-green-400 transition-all duration-300 transform hover:scale-105">
                    Voir les activités réalisées
                </a>
            </div>
        </div>
    </div>
    <!-- Animated background elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-mint opacity-10 rounded-full animate-bounce"></div>
    <div class="absolute bottom-20 right-10 w-16 h-16 bg-mint opacity-10 rounded-full animate-pulse"></div>
    <div class="absolute top-1/2 left-1/4 w-12 h-12 bg-gold opacity-20 rounded-full animate-pulse-slow"></div>
</section>

<!-- Activities Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-4">
        <!-- Filters/Search -->
        <form method="GET" class="bg-white rounded-xl shadow-lg p-4 mb-8 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm text-dark/70 mb-1">Rechercher</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Titre, description..." class="w-full px-3 py-2 border border-mint rounded-lg focus:ring-gold focus:border-gold">
            </div>
            <div>
                <label class="block text-sm text-dark/70 mb-1">Statut</label>
                <select name="status" class="w-full px-3 py-2 border border-mint rounded-lg focus:ring-gold focus:border-gold">
                    <option value="">Tous</option>
                    <option value="upcoming" @selected(request('status')==='upcoming')>À venir</option>
                    <option value="past" @selected(request('status')==='past')>Passées</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-dark/70 mb-1">Du</label>
                <input type="date" name="from" value="{{ request('from') }}" class="w-full px-3 py-2 border border-mint rounded-lg focus:ring-gold focus:border-gold">
            </div>
            <div>
                <label class="block text-sm text-dark/70 mb-1">Au</label>
                <div class="flex gap-2">
                    <input type="date" name="to" value="{{ request('to') }}" class="w-full px-3 py-2 border border-mint rounded-lg focus:ring-gold focus:border-gold">
                    <button class="px-4 py-2 bg-mint text-dark rounded-lg font-medium">Filtrer</button>
                </div>
            </div>
        </form>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($activities as $activity)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 animate-on-scroll group">
                    @if($activity->image_path)
                        <div class="relative overflow-hidden">
                            <img src="{{ Storage::url($activity->image_path) }}" alt="{{ $activity->title }}" class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                        </div>
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-mint to-green-400 flex items-center justify-center">
                            <span class="text-dark text-lg font-semibold">شبكة تنمية القراءة بصفرو</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center text-sm text-dark/60 mb-2">
                            @if($activity->starts_at)
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $activity->starts_at->format('d/m/Y à H:i') }}</span>
                            @endif
                            <span class="mx-2">•</span>
                            <span class="bg-mint/20 text-mint px-2 py-1 rounded-full text-xs">Activité</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-dark group-hover:text-mint transition-colors line-clamp-2">
                            {{ $activity->title }}
                        </h3>
                        @if($activity->excerpt)
                            <p class="text-dark/70 mb-4 line-clamp-3">{{ $activity->excerpt }}</p>
                        @endif
                        <div class="flex items-center justify-between">
                            <a href="{{ route('activities.show', $activity->slug) }}" class="group inline-flex items-center bg-mint text-dark px-4 py-2 rounded-lg font-medium hover:bg-green-400 transition-all duration-300 transform hover:scale-105">
                                <span>En savoir plus</span>
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                            @if($activity->starts_at && $activity->starts_at->isFuture())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-mint/20 text-mint">
                                    À venir
                                </span>
                            @elseif($activity->starts_at && $activity->starts_at->isPast())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-dark/20 text-dark">
                                    Terminé
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 animate-on-scroll">
                    <div class="text-6xl mb-4 animate-bounce">🎯</div>
                    <h3 class="text-2xl font-semibold text-dark/70 mb-2">Aucune activité disponible</h3>
                    <p class="text-dark/50">Il n'y a pas encore d'activités programmées. Revenez bientôt pour découvrir nos événements.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($activities->hasPages())
        <div class="mt-12 flex justify-center">
            <div class="bg-white rounded-xl shadow-lg p-4">
                {{ $activities->links() }}
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