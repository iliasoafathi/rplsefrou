<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Activity;
use App\Models\StaticPage;
use Carbon\Carbon;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample articles
        Article::create([
            'title' => 'Découvrez le patrimoine culturel de Sefrou',
            'slug' => 'decouvrez-patrimoine-culturel-sefrou',
            'excerpt' => 'Sefrou, ville millénaire située au pied du Moyen Atlas, regorge d\'un patrimoine culturel exceptionnel.',
            'content' => '<p>Sefrou, ville millénaire située au pied du Moyen Atlas, regorge d\'un patrimoine culturel exceptionnel. Cette cité historique, fondée au IXe siècle, témoigne d\'une richesse architecturale et culturelle unique au Maroc.</p><p>La médina de Sefrou, classée au patrimoine mondial de l\'UNESCO, abrite de nombreux monuments historiques, des maisons traditionnelles et des souks animés qui perpétuent les traditions ancestrales.</p><p>Chaque année, la ville accueille le Festival des Cerises, un événement emblématique qui célèbre la culture locale et attire des visiteurs du monde entier.</p>',
            'is_visible' => true,
            'published_at' => Carbon::now()->subDays(2),
        ]);

        Article::create([
            'title' => 'Le Festival des Cerises 2024 : Un succès retentissant',
            'slug' => 'festival-cerises-2024-succes',
            'excerpt' => 'La 102e édition du Festival des Cerises de Sefrou a connu un succès exceptionnel avec plus de 50 000 visiteurs.',
            'content' => '<p>La 102e édition du Festival des Cerises de Sefrou a connu un succès exceptionnel avec plus de 50 000 visiteurs venus de tout le Maroc et de l\'étranger.</p><p>Cette édition a été marquée par une programmation culturelle riche et variée, incluant des spectacles de musique traditionnelle, des expositions d\'artisanat local, et des démonstrations culinaires.</p><p>Le festival a également mis à l\'honneur les producteurs locaux de cerises, dont la qualité est reconnue internationalement.</p>',
            'is_visible' => true,
            'published_at' => Carbon::now()->subDays(5),
        ]);

        Article::create([
            'title' => 'Sefrou : Une destination touristique en plein essor',
            'slug' => 'sefrou-destination-touristique-essor',
            'excerpt' => 'La ville de Sefrou connaît un développement touristique remarquable grâce à ses atouts naturels et culturels.',
            'content' => '<p>La ville de Sefrou connaît un développement touristique remarquable grâce à ses atouts naturels et culturels exceptionnels.</p><p>Située à proximité des cascades d\'Ouzoud et des forêts de cèdres du Moyen Atlas, Sefrou offre aux visiteurs une expérience unique alliant nature et culture.</p><p>Les autorités locales investissent massivement dans l\'amélioration des infrastructures touristiques pour accueillir un nombre croissant de visiteurs.</p>',
            'is_visible' => true,
            'published_at' => Carbon::now()->subWeek(),
        ]);

        // Create sample activities
        Activity::create([
            'title' => 'Visite guidée de la médina de Sefrou',
            'slug' => 'visite-guidee-medina-sefrou',
            'excerpt' => 'Découvrez les secrets de la médina historique de Sefrou avec nos guides experts.',
            'description' => '<p>Rejoignez-nous pour une visite guidée exceptionnelle de la médina de Sefrou, classée au patrimoine mondial de l\'UNESCO.</p><p>Cette visite de 3 heures vous permettra de découvrir :</p><ul><li>L\'architecture traditionnelle de la médina</li><li>Les souks historiques et l\'artisanat local</li><li>Les monuments emblématiques de la ville</li><li>L\'histoire millénaire de Sefrou</li></ul><p>Réservation obligatoire. Tarif : 50 MAD par personne.</p>',
            'starts_at' => Carbon::now()->addDays(7)->setTime(10, 0),
            'ends_at' => Carbon::now()->addDays(7)->setTime(13, 0),
            'is_visible' => true,
        ]);

        Activity::create([
            'title' => 'Atelier de poterie traditionnelle',
            'slug' => 'atelier-poterie-traditionnelle',
            'excerpt' => 'Apprenez l\'art de la poterie traditionnelle avec nos maîtres artisans locaux.',
            'description' => '<p>Participez à un atelier unique de poterie traditionnelle animé par nos maîtres artisans locaux.</p><p>Au programme :</p><ul><li>Découverte des techniques ancestrales</li><li>Fabrication de votre propre poterie</li><li>Initiation aux motifs traditionnels</li><li>Dégustation de thé à la menthe</li></ul><p>Matériel fourni. Atelier adapté à tous les niveaux.</p>',
            'starts_at' => Carbon::now()->addDays(14)->setTime(14, 0),
            'ends_at' => Carbon::now()->addDays(14)->setTime(17, 0),
            'is_visible' => true,
        ]);

        Activity::create([
            'title' => 'Randonnée dans les forêts de cèdres',
            'slug' => 'randonnee-forets-cedres',
            'excerpt' => 'Explorez les magnifiques forêts de cèdres du Moyen Atlas lors d\'une randonnée guidée.',
            'description' => '<p>Partez à la découverte des forêts de cèdres du Moyen Atlas lors d\'une randonnée guidée de 6 heures.</p><p>Cette excursion vous emmènera :</p><ul><li>À travers les sentiers forestiers</li><li>À la rencontre de la faune locale</li><li>Vers des points de vue exceptionnels</li><li>À la découverte de la flore endémique</li></ul><p>Niveau : Intermédiaire. Équipement de randonnée recommandé.</p>',
            'starts_at' => Carbon::now()->addDays(21)->setTime(8, 0),
            'ends_at' => Carbon::now()->addDays(21)->setTime(14, 0),
            'is_visible' => true,
        ]);

        // Create static pages
        StaticPage::create([
            'slug' => 'about',
            'title' => 'À propos de RPL Sefrou',
            'content' => '<p>RPL Sefrou est votre plateforme d\'information locale dédiée à la ville de Sefrou et sa région. Nous nous engageons à vous fournir des informations actualisées sur les événements, les activités culturelles, et les actualités locales.</p><p>Notre mission est de promouvoir le patrimoine culturel de Sefrou et de créer des liens entre les habitants et les visiteurs de notre belle région.</p>',
        ]);

        StaticPage::create([
            'slug' => 'contact',
            'title' => 'Contactez-nous',
            'content' => '<p>Vous avez des questions, des suggestions ou souhaitez contribuer à notre contenu ? N\'hésitez pas à nous contacter. Nous serions ravis d\'avoir de vos nouvelles.</p><p>Notre équipe est disponible du lundi au vendredi de 9h00 à 17h00.</p>',
        ]);
    }
}
