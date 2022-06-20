<?php

namespace App\DataFixtures;

use App\Entity\TypeEvent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


final class TypeEventFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $types = [
            ['name' => "Assemblée territoriale", 'isObligated' => true],
            ['name' => "Conseil territorial", 'isObligated' => false],
            ['name' => "Conseil territorial élargi", 'isObligated' => true],
            ['name' => "Réunion équipe territoriale", 'isObligated' => false],
            ['name' => "Réunion pôle pédagogique", 'isObligated' => false],
            ['name' => "Réunion pôle adm. et financier", 'isObligated' => false],
            ['name' => "Week-end territorial", 'isObligated' => true],
            ['name' => "Conseil de groupe", 'isObligated' => true],
            ['name' => "Réunion d'unité", 'isObligated' => true],
            ['name' => "Conseil de chefs", 'isObligated' => false],
            ['name' => "Week-end d'unité", 'isObligated' => true],
            ['name' => "Réunion de groupe", 'isObligated' => false],
            ['name' => "Week-end de groupe", 'isObligated' => false],
            ['name' => "Réunion diverse", 'isObligated' => false]
        ];

        $i = 0;
        foreach ($types as $type) {
            $typeEvent1 = new TypeEvent();
            $typeEvent1
                ->setName($type['name'])
                ->setIsActive(true)
                ->setIsObligated($type['isObligated']);

            $manager->persist($typeEvent1);
            $this->addReference('type_event_' . $i++, $typeEvent1);

        }
        $manager->flush();
    }

}
