<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        $regex = '/Brand_\d+/';
        $refBrand = 0;
        foreach (array_keys($this->referenceRepository->getReferences()) as $ref) {
            if (!preg_match($regex, $ref)) {
                continue;
            }
            $this->createMany(
                Article::class,
                rand(0, 20),
                function ($article) use ($ref) {
                    $article
                        ->setName($this->faker->sentence)
                        ->setPrice($this->faker->randomFloat())
                        ->setDescription($this->faker->text)
                        ->setImage($this->faker->imageUrl())
                        ->setBrand($this->getReference($ref))
                    ;
                },
                $refBrand
            );
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            BrandFixtures::class,
        );
    }
}
