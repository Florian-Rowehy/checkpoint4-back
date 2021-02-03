<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $departmentNames = [
            "hat",
            "shoes",
            "coats",
            "underwear"
        ];
        $i = 0;
        foreach ($departmentNames as $departmentName) {
            $department = new Department();
            $department->setName($departmentName);
            $manager->persist($department);
            $this->setReference('Department_'.$i, $department);
            $i++;
        }
        $manager->flush();
    }
}
