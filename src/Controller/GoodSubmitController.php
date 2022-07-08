<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GoodSubmitController extends AbstractController
{
    /**
     * @Route("/good/submit", name="app_formulaire_2")
     */
    // retreive data of the current user
    public function goodSubmit(): Response
    {
        $user = $this->getUser();


        return $this->render('good_submit/index.html.twig', [
            'user' => $user,
        ]);
    }
}
