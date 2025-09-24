@extends('layouts.app')

@section('title', 'Recherche - RPL Sefrou')
@section('description', 'Recherchez dans nos articles, activités et membres.')

@section('content')
<div class="bg-light py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-dark mb-4">
                Résultats pour "<span class="text-gold">{{ $query }}</span>"
            </h1>
            <p class="text-lg text-dark max-w-2xl mx-auto">
                Découvrez tous les contenus correspondant à votre recherche.
            </p>
        </div>

        <!-- Search Form -->
        <div class="max-w-2xl mx-auto mb-12">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="q" placeholder="Rechercher..." 
                       value="{{ $query }}"
                       class="w-full px-6 py-4 pl-12 pr-4 text-lg text-dark bg-white border-2 border-mint rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold shadow-lg">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-6 w-6 text-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button type="submit" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <svg class="h-6 w-6 text-gold hover:text-dark transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Results -->
        <div class="space-y-16">
            <!-- Articles Results -->
            @if($articles->count() > 0)
            <section>
                <h2 class="text-3xl font-bold text-dark mb-8 flex items-center">
                    <svg class="w-8 h-8 text-gold mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Articles ({{ $articles->total() }})
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $article)
                    <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow border border-mint">
                        @if($article->cover_image_path)
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset('storage/' . $article->cover_image_path) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center text-sm text-dark mb-2">
                                <time datetime="{{ $article->published_at }}">{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</time>
                            </div>
                            <h3 class="text-xl font-semibold text-dark mb-3 line-clamp-2">
                                <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-gold transition-colors">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            @if($article->excerpt)
                            <p class="text-dark mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                            @endif
                            <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center text-gold hover:text-dark font-medium">
                                Lire la suite
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
                @if($articles->hasPages())
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
                @endif
            </section>
            @endif

            <!-- Activities Results -->
            @if($activities->count() > 0)
            <section>
                <h2 class="text-3xl font-bold text-dark mb-8 flex items-center">
                    <svg class="w-8 h-8 text-gold mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Activités ({{ $activities->total() }})
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($activities as $activity)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow border border-mint">
                        @if($activity->image_path)
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset('storage/' . $activity->image_path) }}" alt="{{ $activity->title }}" class="w-full h-48 object-cover">
                        </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center text-sm text-dark mb-2">
                                @if($activity->starts_at)
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <time datetime="{{ $activity->starts_at }}">{{ $activity->starts_at->format('d M Y à H:i') }}</time>
                                @endif
                            </div>
                            <h3 class="text-xl font-semibold text-dark mb-3 line-clamp-2">
                                <a href="{{ route('activities.show', $activity->slug) }}" class="hover:text-gold transition-colors">
                                    {{ $activity->title }}
                                </a>
                            </h3>
                            @if($activity->excerpt)
                            <p class="text-dark mb-4 line-clamp-3">{{ $activity->excerpt }}</p>
                            @endif
                            <a href="{{ route('activities.show', $activity->slug) }}" class="inline-flex items-center text-gold hover:text-dark font-medium">
                                En savoir plus
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($activities->hasPages())
                <div class="mt-8">
                    {{ $activities->links() }}
                </div>
                @endif
            </section>
            @endif

            <!-- Members Results -->
            @if($members->count() > 0)
            <section>
                <h2 class="text-3xl font-bold text-dark mb-8 flex items-center">
                    <svg class="w-8 h-8 text-gold mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    Membres ({{ $members->total() }})
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($members as $member)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow border border-mint">
                        <div class="relative">
                            @if($member->profile_image_path)
                                <img src="{{ asset('storage/' . $member->profile_image_path) }}" 
                                     alt="{{ $member->name }}" 
                                     class="w-full h-64 object-cover">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-mint to-light flex items-center justify-center">
                                    <div class="text-6xl text-dark font-bold">
                                        {{ substr($member->name, 0, 1) }}
                                    </div>
                                </div>
                            @endif
                            
                            @if($member->position)
                            <div class="absolute top-4 right-4">
                                <span class="bg-gold text-dark px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $member->position }}
                                </span>
                            </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-dark mb-2">{{ $member->name }}</h3>
                            
                            @if($member->bio)
                            <p class="text-dark mb-4 line-clamp-3">{{ $member->bio }}</p>
                            @endif

                            @if($member->email)
                            <div class="flex items-center text-sm text-dark mb-2">
                                <svg class="w-4 h-4 mr-2 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="truncate">{{ $member->email }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($members->hasPages())
                <div class="mt-8">
                    {{ $members->links() }}
                </div>
                @endif
            </section>
            @endif

            <!-- No Results -->
            @if($articles->count() === 0 && $activities->count() === 0 && $members->count() === 0)
            <div class="text-center py-16">
                <div class="text-6xl text-mint mb-4">🔍</div>
                <h3 class="text-2xl font-semibold text-dark mb-4">Aucun résultat trouvé</h3>
                <p class="text-dark mb-8">Essayez avec d'autres mots-clés ou explorez nos contenus.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('articles.index') }}" class="bg-gold text-dark px-6 py-3 rounded-lg font-semibold hover:bg-dark hover:text-gold transition-colors">
                        Voir tous les articles
                    </a>
                    <a href="{{ route('activities.index') }}" class="bg-mint text-dark px-6 py-3 rounded-lg font-semibold hover:bg-dark hover:text-mint transition-colors">
                        Voir toutes les activités
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
