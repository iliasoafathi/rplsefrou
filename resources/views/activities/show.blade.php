@extends('layouts.app')

@section('title', $activity->title . ' - شبكة تنمية القراءة بصفرو')
@section('description', $activity->excerpt ?: 'Découvrez cette activité organisée à Sefrou.')

@section('content')
<article class="bg-white">
    <!-- Activity Header -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Accueil</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('activities.index') }}" class="hover:text-blue-600">Activités</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-900">{{ $activity->title }}</li>
            </ol>
        </nav>

        <!-- Activity Meta -->
        <div class="mb-8">
            <div class="flex items-center text-sm text-gray-500 mb-4">
                @if($activity->starts_at)
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <time datetime="{{ $activity->starts_at }}">{{ $activity->starts_at->format('d M Y à H:i') }}</time>
                @if($activity->ends_at)
                <span class="mx-2">-</span>
                <time datetime="{{ $activity->ends_at }}">{{ $activity->ends_at->format('d M Y à H:i') }}</time>
                @endif
                @endif
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $activity->title }}
            </h1>
            
            @if($activity->excerpt)
            <p class="text-xl text-gray-600 leading-relaxed">
                {{ $activity->excerpt }}
            </p>
            @endif
        </div>

        <!-- Activity Image -->
        @if($activity->image_path)
        <div class="mb-12">
            <img src="{{ Storage::url($activity->image_path) }}" alt="{{ $activity->title }}" class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg">
        </div>
        @endif

        <!-- Activity Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <div class="lg:col-span-2">
                @if($activity->description)
                <div class="prose prose-lg max-w-none">
                    {!! $activity->description !!}
                </div>
                @endif
            </div>
            
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Détails de l'activité</h3>
                    
                    @if($activity->starts_at)
                    <div class="mb-4">
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">Début</span>
                        </div>
                        <p class="text-gray-900">{{ $activity->starts_at->format('d M Y à H:i') }}</p>
                    </div>
                    @endif
                    
                    @if($activity->ends_at)
                    <div class="mb-4">
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">Fin</span>
                        </div>
                        <p class="text-gray-900">{{ $activity->ends_at->format('d M Y à H:i') }}</p>
                    </div>
                    @endif
                    
                    <div class="mb-4">
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="font-medium">Lieu</span>
                        </div>
                        <p class="text-gray-900">Sefrou, Maroc</p>
                    </div>
                    
                    @if($activity->starts_at)
                    <div class="mt-6">
                        @if($activity->starts_at->isFuture())
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            À venir
                        </span>
                        @elseif($activity->starts_at->isPast())
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Terminé
                        </span>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Activity Footer -->
        <div class="pt-8 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div class="mb-4 sm:mb-0">
                    <p class="text-sm text-gray-500">
                        Créé le {{ $activity->created_at->format('d M Y à H:i') }}
                    </p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('activities.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour aux activités
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Related Activities -->
@if($relatedActivities->count() > 0)
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Autres activités</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedActivities as $relatedActivity)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($relatedActivity->image_path)
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ Storage::url($relatedActivity->image_path) }}" alt="{{ $relatedActivity->title }}" class="w-full h-32 object-cover">
                </div>
                @endif
                <div class="p-4">
                    <div class="flex items-center text-xs text-gray-500 mb-2">
                        @if($relatedActivity->starts_at)
                        <time datetime="{{ $relatedActivity->starts_at }}">{{ $relatedActivity->starts_at->format('d M Y') }}</time>
                        @endif
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2">
                        <a href="{{ route('activities.show', $relatedActivity->slug) }}" class="hover:text-blue-600 transition-colors">
                            {{ $relatedActivity->title }}
                        </a>
                    </h3>
                    @if($relatedActivity->excerpt)
                    <p class="text-xs text-gray-600 line-clamp-2">{{ $relatedActivity->excerpt }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
