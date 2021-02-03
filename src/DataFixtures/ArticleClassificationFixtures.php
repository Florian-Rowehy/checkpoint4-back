<?php

namespace App\DataFixtures;

use App\Entity\ArticleClassification;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleClassificationFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        $departmentRegex = '/Department_\d+/';
        $refArticleClassification= 0;
        foreach (array_keys($this->referenceRepository->getReferences()) as $ref) {
            if (!preg_match($departmentRegex, $ref)) {
                continue;
            }
            $this->createMany(
                ArticleClassification::class,
                5,
                function ($classification, $i, $refArticleClassification) use ($ref) {
                    $classification
                        ->setName('classification'.$refArticleClassification)
                        ->setDepartement($this->getReference($ref))
                    ;
                },
                $refArticleClassification
            );
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            DepartmentFixtures::class,
        );
    }
}
