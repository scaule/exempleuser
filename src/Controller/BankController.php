<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BankController extends AbstractController
{
    #[Route('/', name: 'app_bank')]
    public function index(): Response
    {
        return $this->render('bank/index.html.twig', []);
    }
}
