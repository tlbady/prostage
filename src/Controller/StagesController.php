<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StagesController extends AbstractController
{
    /**
     * @Route("/stages/{id}", name="stages")
     */
    public function index(int $id)
    {
        return $this->render('stages/index.html.twig', [
            'id_stage' => $id,
        ]);
    }
}
