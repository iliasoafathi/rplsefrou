@extends('layouts.app')

@section('title', 'À propos - RPL Sefrou')
@section('description', 'Découvrez RPL Sefrou, votre source d\'information locale pour Sefrou et sa région.')

@section('content')
<div class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">À propos de RPL Sefrou</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Votre source d'information locale pour découvrir Sefrou, ses activités, ses événements et son patrimoine culturel.
            </p>
        </div>

        <!-- Content -->
        <div class="prose prose-lg max-w-none">
            @if($page && $page->content)
                {!! $page->content !!}
            @else
                <div class="space-y-8">
                    <section>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Notre Mission</h2>
                        <p class="text-gray-600 leading-relaxed">
                            RPL Sefrou est votre plateforme d'information locale dédiée à la ville de Sefrou et sa région. 
                            Nous nous engageons à vous fournir des informations actualisées sur les événements, 
                            les activités culturelles, et les actualités locales.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Notre Vision</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Notre mission est de promouvoir le patrimoine culturel de Sefrou et de créer des liens 
                            entre les habitants et les visiteurs de notre belle région. Nous croyons en la richesse 
                            de notre culture locale et souhaitons la partager avec le monde entier.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Ce que nous offrons</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-blue-900 mb-2">Articles informatifs</h3>
                                <p class="text-blue-700">
                                    Des articles détaillés sur l'histoire, la culture et les actualités de Sefrou.
                                </p>
                            </div>
                            <div class="bg-green-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-green-900 mb-2">Activités et événements</h3>
                                <p class="text-green-700">
                                    Informations sur les activités culturelles, festivals et événements locaux.
                                </p>
                            </div>
                            <div class="bg-yellow-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-yellow-900 mb-2">Patrimoine culturel</h3>
                                <p class="text-yellow-700">
                                    Découvrez le riche patrimoine historique et culturel de notre région.
                                </p>
                            </div>
                            <div class="bg-purple-50 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-purple-900 mb-2">Communauté locale</h3>
                                <p class="text-purple-700">
                                    Connectez-vous avec la communauté locale et participez aux événements.
                                </p>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Notre équipe</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Notre équipe est composée de passionnés de la culture locale, d'historiens, 
                            de journalistes et de membres de la communauté qui partagent tous la même passion 
                            pour Sefrou et sa région. Nous travaillons ensemble pour vous offrir un contenu 
                            de qualité et des informations fiables.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Contactez-nous</h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Vous avez des questions, des suggestions ou souhaitez contribuer à notre contenu ? 
                            N'hésitez pas à nous contacter. Nous serions ravis d'avoir de vos nouvelles.
                        </p>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Adresse</h4>
                                    <p class="text-gray-600">Sefrou, Maroc</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Email</h4>
                                    <p class="text-gray-600">contact@rplsefrou.ma</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endif
        </div>

        <!-- Call to Action -->
        <div class="mt-12 text-center">
            <a href="{{ route('contact') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                Nous contacter
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
