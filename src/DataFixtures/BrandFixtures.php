<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        $this->createMany(Brand::class, 10, function ($brand) {
            $brand->setName($this->faker->name);
        });
        $manager->flush();
    }
}
