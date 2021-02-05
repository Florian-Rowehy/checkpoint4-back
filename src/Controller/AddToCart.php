<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AddToCart extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Article $data)
    {
        $user = $this->getUser();
        $user->addCart($data);
        $this->em->flush();
        return $user->getCart();
    }
}
