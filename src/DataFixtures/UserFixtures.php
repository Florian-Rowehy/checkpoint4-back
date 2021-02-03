<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);
        $user = new User();
        $user
            ->setUsername('user')
            ->setPassword($this->userPasswordEncoder->encodePassword($user, 'password'))
            ->setEmail('user@gmail.com')
            ->setFirstname('moi')
            ->setLastname('me')
            ->setAddress($this->faker->address)
        ;
        $manager->persist($user);

        $admin = new User();
        $admin
            ->setUsername('admin')
            ->setPassword($this->userPasswordEncoder->encodePassword($admin, 'password'))
            ->setEmail('admin@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setFirstname($this->faker->firstName)
            ->setLastname($this->faker->lastName)
            ->setAddress($this->faker->address)
        ;
        $manager->persist($admin);

        $this->createMany(User::class, 10, function ($user) {
            $user
                ->setUsername($this->faker->userName)
                ->setPassword($this->userPasswordEncoder->encodePassword($user, 'password'))
                ->setEmail($this->faker->email)
                ->setFirstname($this->faker->firstName)
                ->setLastname($this->faker->lastName)
                ->setAddress($this->faker->address)
            ;
        });
        $manager->flush();
    }
}
