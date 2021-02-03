<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categoryNames = [
            "men",
            "women",
            "boys",
            "girls"
        ];
        $i = 0;
        foreach ($categoryNames as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->setReference('Category_'.$i, $category);
            $i++;
        }
        $manager->flush();
    }
}
