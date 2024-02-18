<?php

namespace App\DataFixtures;

use App\Entity\BookCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookCategoryFixtures extends Fixture
{
    public const CATEGORY_CLASSIC = 'classics';
    public const CATEGORY_NON_FICTION = 'non-fiction';
    public const CATEGORY_ADVENTURES = 'adventures';

    public function load(ObjectManager $manager): void
    {
        $bookCategory1 = new BookCategory();
        $bookCategory1->setTitle('Non-fiction');
        $bookCategory1->setSlug('non-fiction');

        $bookCategory3 = new BookCategory();
        $bookCategory3->setTitle('Adventures');
        $bookCategory3->setSlug('adventures');

        $bookCategory2 = new BookCategory();
        $bookCategory2->setTitle('Classics');
        $bookCategory2->setSlug('classics');

        $categories = [
          self::CATEGORY_CLASSIC => $bookCategory2,
          self::CATEGORY_ADVENTURES => $bookCategory3,
          self::CATEGORY_NON_FICTION => $bookCategory1,
        ];

        foreach ($categories as $category) {
            $manager->persist($category);
        }

        $bookCategory = new BookCategory();
        $bookCategory->setTitle('Fantasy');
        $bookCategory->setSlug('fantasy');
        $manager->persist($bookCategory);

        $manager->flush();

        foreach ($categories as $type => $category) {
            $this->addReference($type, $category);
        }
    }
}
