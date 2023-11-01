<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Vues panoramiques',
                'Vue sur le jardin',
                'Vue sur la piscine',
                'Salle de bain',
                'Sèche-cheveux',
                'Produits de nettoyage',
                'Eau chaude',
                'Chambre et linge',
                'Lave-linge (Gratuit) dans le logement',
                'Équipements de base',
                'Serviettes, draps, savon et papier toilette',
                'Cintres',
                'Draps',
                'Linge de lit en coton',
                'Oreillers et couvertures supplémentaires',
                'Fer à repasser',
                'Étendoir à linge',
                'Espace de rangement pour les vêtements : placard',
                'Divertissement',
                'Télévision',
                'Cinéma',
                'Laser game',
                'Chauffage et climatisation',
                'Climatisation centrale',
                'Chauffage',
                'Sécurité à la maison',
                'Détecteur de fumée',
                'Détecteur de monoxyde de carbone',
                'Internet et bureau',
                'Wifi',
                'Cuisine et salle à manger',
                'Cuisine',
                'Espace où les voyageurs peuvent cuisiner',
                'Four à micro-ondes',
                'Équipements de cuisine de base',
                'Casseroles et poêles, huile, sel et poivre',
                'Vaisselle et couverts',
                'Bols, baguettes, assiettes, tasses, etc.',
                'Mini réfrigérateur',
                'Cuisinière',
                'Bouilloire électrique',
                'Cafetière',
                'Verres à vin',
                'Grille-pain',
                'Table à manger',
                'Caractéristiques de l\'emplacement',
                'Entrée privée',
                'Entrée par une rue différente ou un immeuble séparé',
                'Patio ou balcon : privé(e)',
                'Mobilier d\'extérieur',
                'Espace repas en plein air',
                'Chaises longues',
                'Parking et installations',
                'Parking gratuit sur place',
                'Parking gratuit dans la rue',
                'Piscine Privé extérieure (disponible à certaines périodes, couloir de nage)',
                'Disponible entre janv. et sept.',
                'Logement de plain-pied',
                'Pas d\'escaliers dans le logement',
                'Dépôt de bagages autorisé',
                'Pour le confort des voyageurs en cas d\'arrivée anticipée ou de départ tardif',
                'Séjours longue durée autorisés',
                'Séjours de 28 jours ou plus autorisés',
                'Indisponible : Caméras de surveillance extérieure et/ou dans les espaces communs',
                'Indisponible : Sèche-linge',
            ]),
        ];
    }
}
