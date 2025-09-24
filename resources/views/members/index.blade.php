@extends('layouts.app')

@section('title', 'Membres - RPL Sefrou')
@section('description', 'Découvrez les membres de RPL Sefrou, une équipe passionnée dédiée à la promotion de notre région.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-black to-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                Notre <span class="text-yellow-400">Équipe</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Rencontrez les membres passionnés de RPL Sefrou qui œuvrent chaque jour pour promouvoir notre belle région.
            </p>
        </div>
    </div>
</section>

<!-- Members Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filters/Search -->
        <form method="GET" class="bg-white rounded-xl shadow-lg p-4 mb-8 grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Rechercher</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Nom, poste..." class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Depuis</label>
                <input type="date" name="from" value="{{ request('from') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Jusqu'à</label>
                <div class="flex gap-2">
                    <input type="date" name="to" value="{{ request('to') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                    <button class="px-4 py-2 bg-yellow-500 text-black rounded-lg font-semibold">Filtrer</button>
                </div>
            </div>
        </form>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($members as $member)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow border border-gray-200">
                <!-- Profile Image -->
                <div class="relative">
                    @if($member->profile_image_path)
                        <img src="{{ Storage::url($member->profile_image_path) }}" 
                             alt="{{ $member->name }}" 
                             class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                            <div class="text-6xl text-yellow-600 font-bold">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                        </div>
                    @endif
                    
                    <!-- Position Badge -->
                    @if($member->position)
                    <div class="absolute top-4 right-4">
                        <span class="bg-yellow-500 text-black px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $member->position }}
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Member Info -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-black mb-2">{{ $member->name }}</h3>
                    
                    @if($member->bio)
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $member->bio }}</p>
                    @endif

                    <!-- Contact Info -->
                    <div class="space-y-2 mb-4">
                        @if($member->email)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="truncate">{{ $member->email }}</span>
                        </div>
                        @endif

                        @if($member->phone)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>{{ $member->phone }}</span>
                        </div>
                        @endif

                        @if($member->joined_at)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Membre depuis {{ $member->joined_at->format('M Y') }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-6xl text-gray-300 mb-4">👥</div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Aucun membre trouvé</h3>
                <p class="text-gray-500">Les membres de l'équipe seront bientôt affichés ici.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Join Us Section -->
<section class="py-16 bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-black mb-6">
            Rejoignez notre <span class="text-yellow-600">équipe</span>
        </h2>
        <p class="text-lg text-gray-700 mb-8">
            Vous souhaitez contribuer à la promotion de Sefrou et de sa région ? 
            Contactez-nous pour découvrir comment vous pouvez nous rejoindre.
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center bg-yellow-500 text-black px-8 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">
            Nous contacter
            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</section>
@endsection
