@extends('layouts.app')

@section('title', 'Activités réalisées - شبكة تنمية القراءة بصفرو')
@section('description', "Découvrez nos activités déjà réalisées à Sefrou.")

@section('content')
<section class="hero-gradient text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">Activités réalisées</h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">Retrouvez les actions et événements passés</p>
            <div>
                <a href="{{ route('activities.index') }}" class="inline-flex items-center bg-mint text-dark px-4 py-2 rounded-lg font-medium hover:bg-green-400 transition">
                    Voir toutes les activités
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-light">
    <div class="container mx-auto px-4">
        <form method="GET" class="bg-white rounded-xl shadow-lg p-4 mb-8 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm text-dark/70 mb-1">Rechercher</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Titre, description..." class="w-full px-3 py-2 border border-mint rounded-lg focus:ring-gold focus:border-gold">
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
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 group">
                    @if($activity->image_path)
                        <div class="relative overflow-hidden">
                            <img src="{{ Storage::url($activity->image_path) }}" alt="{{ $activity->title }}" class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
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
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-dark/20 text-dark">Terminé</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-dark group-hover:text-mint transition-colors line-clamp-2">
                            {{ $activity->title }}
                        </h3>
                        @if($activity->excerpt)
                            <p class="text-dark/70 mb-4 line-clamp-3">{{ $activity->excerpt }}</p>
                        @endif
                        <div class="flex items-center justify-between">
                            <a href="{{ route('activities.show', $activity->slug) }}" class="group inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                <span>Voir</span>
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-6xl mb-4">✅</div>
                    <h3 class="text-2xl font-semibold text-dark/70 mb-2">Aucune activité réalisée trouvée</n3>
                    <p class="text-dark/50">Essayez d’ajuster vos filtres ou revenez plus tard.</p>
                </div>
            @endforelse
        </div>

        @if($activities->hasPages())
        <div class="mt-12 flex justify-center">
            <div class="bg-white rounded-xl shadow-lg p-4">
                {{ $activities->links() }}
            </div>
        </div>
        @endif
    </div>
</section>
@endsection


