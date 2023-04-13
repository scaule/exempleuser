<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountType;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/accounts', name: 'app_accounts')]
    public function index(AccountRepository $ar): Response
    {
        return $this->render('account/index.html.twig', [
            'accounts' => $ar->findAll()
        ]);
    }

    #[Route('/accounts/add', name: 'app_account_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $account = new Account();
        $account->setAmount(100);
        $form = $this->createForm(AccountType::class, $account);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $account = $form->getData();
            $em->persist($account);
            $em->flush();
            return $this->redirectToRoute('app_accounts');
        }

        return $this->render('account/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

