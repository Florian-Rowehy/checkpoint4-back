<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixtures implements DependentFixtureInterface
{
    private array $categories = [];
    private array $brand = [];
    private array $classification = [];

    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        $brandRegex = '/Brand_\d+/';
        $categoryRegex = '/Category_\d+/';
        $classificationRegex = '/ArticleClassification_\d+/';
        $refBrand = 0;
        foreach (array_keys($this->referenceRepository->getReferences()) as $ref) {
            if (preg_match($brandRegex, $ref)) {
                $this->brand[] = $ref;
            } elseif (preg_match($categoryRegex, $ref)) {
                $this->categories[] = $ref;
            } elseif (preg_match($classificationRegex, $ref)) {
                $this->classification[] = $ref;
            }
        }

        foreach ($this->brand as $ref) {
            $this->createMany(
                Article::class,
                rand(10, 20),
                function ($article) use ($ref) {
                    $article
                        ->setName($this->faker->sentence)
                        ->setPrice($this->faker->randomFloat())
                        ->setDescription($this->faker->text)
                        ->setImage("https://placehold.it/350x150")
                        ->setBrand($this->getReference($ref))
                    ;

                    $randCategory = array_rand($this->categories);
                    $randClassification = array_rand($this->classification);
                    $article->addCategory($this->getReference($this->categories[$randCategory]));
                    $article->setArticleClassification($this->getReference($this->classification[$randClassification]));

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
            CategoryFixtures::class,
            ArticleClassificationFixtures::class,
        );
    }
}
