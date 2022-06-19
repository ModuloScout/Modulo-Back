<?php

namespace App\DataFixtures;

use App\Entity\Feature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FeatureFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $features = [
            ['name' => "Créer un évènement, le modifier, le supprimer"],
            ['name' => "Modifier les évènements créés par un tiers dans ma structure"],
            ['name' => "Modifier les évènements créés par un tiers dans une structure enfant"],
            ['name' => "Supprimer les évènements crées par un tiers"],
            ['name' => "Supprimer les évènements créés par un tiers dans une structure enfant"],
            ['name' => "Personnaliser les fonctions invitées"],
            ['name' => "Définir des invitations nominatives"],
            ['name' => "Personnaliser la visibilité de l'événement"],
            ['name' => "Voir les événements de ma structure et des structures parentes"],
            ['name' => "Voir les événements des structures enfant"],
        ];

        $i = 0;
        foreach ($features as $feature) {
            $features1 = new Feature();
            $features1
                ->setName($feature['name']);

            $manager->persist($features1);
            $this->addReference('feature_' . $i++, $features1);
        }

        $manager->flush();

    }
}
