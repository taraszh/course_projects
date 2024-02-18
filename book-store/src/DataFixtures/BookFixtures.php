<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\BookCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $classicsCategory = $this->getReference(BookCategoryFixtures::CATEGORY_CLASSIC);
        $nonFictionCategory = $this->getReference(BookCategoryFixtures::CATEGORY_NON_FICTION);
        $adventuresCategory = $this->getReference(BookCategoryFixtures::CATEGORY_ADVENTURES);

        $book = new Book();
        $book->setTitle('Robur the conquer');
        $book->setSlug('robur-the-conquer');
        $book->setMeap(false);
        $book->setAuthors(['Jules Verne']);
        $book->setImage('https://images.squarespace-cdn.com/content/v1/5e1e5ef4c84b953ac52564ba/1632864310367-YCD4SZOSPX3VKAYH79Z8/1887-L%C3%A9onBenett-TheClipperOfTheClouds3.jpg');
        $book->setCategory(new ArrayCollection([$classicsCategory, $adventuresCategory]));
        $book->setPublicationDate(new \DateTime('1886-01-01'));
        $manager->persist($book);

//        $bookCategory = new Book();
//        $bookCategory->setTitle('Pride and Prejudice');
//        $bookCategory->setSlug('pride_and_prejudice');
//
//        $manager->persist($bookCategory);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BookCategoryFixtures::class
        ];
    }
}
