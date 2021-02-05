<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class GetCart extends AbstractController
{
    /**
     * @Route("/api/cart", methods={"GET"})
     */
    public function getCart()
    {
        $user = $this->getUser();
        return $this->json($user->getCart());
    }
}
