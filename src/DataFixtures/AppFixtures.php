<?php

namespace App\DataFixtures;

use App\Entity\Note;
use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        # first organization
        $organization = new Organization('test1', 'Test 1');
        $manager->persist($organization);

        $note = new Note("note-1 test1");
        $note->setTenant($organization);
        $manager->persist($note);

        $note = new Note("note-2 test1");
        $note->setTenant($organization);
        $manager->persist($note);

        # Second organization
        $organization = new Organization('test2', 'Test 2');
        $manager->persist($organization);

        $note = new Note("note-3 test2");
        $note->setTenant($organization);
        $manager->persist($note);

        $note = new Note("note-4 test2");
        $note->setTenant($organization);
        $manager->persist($note);

        #save
        $manager->flush();
    }
}
