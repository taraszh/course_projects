<?php

namespace App\DataFixtures;

use App\Entity\BookCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $bookCategory = new BookCategory();
        $bookCategory->setTitle('Robur the conquer');
        $bookCategory->setSlug('robur_the_conquer');
        $manager->persist($bookCategory);

        $bookCategory = new BookCategory();
        $bookCategory->setTitle('Pride and Prejudice');
        $bookCategory->setSlug('pride_and_prejudice');
        $manager->persist($bookCategory);


        $manager->flush();
    }
}
