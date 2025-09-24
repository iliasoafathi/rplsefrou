@extends('layouts.app')

@section('title', $page->title . ' - RPL Sefrou')
@section('description', 'Découvrez cette page sur RPL Sefrou.')

@section('content')
<div class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Accueil</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-900">{{ $page->title }}</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $page->title }}</h1>
        </div>

        <!-- Page Content -->
        <div class="prose prose-lg max-w-none">
            {!! $page->content !!}
        </div>

        <!-- Page Footer -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div class="mb-4 sm:mb-0">
                    <p class="text-sm text-gray-500">
                        Dernière mise à jour le {{ $page->updated_at->format('d M Y à H:i') }}
                    </p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
