<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProstageController extends AbstractController
{
    /**
     * @Route("/", name="prostage")
     */
    public function index()
    {
        return $this->render('prostage/index.html.twig');
    }

    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function entreprises()
    {
        return $this->render('prostage/entreprises.html.twig');
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function formations()
    {
        return $this->render('prostage/formations.html.twig');
    }

    /**
     * @Route("/stages/{id}", name="stages")
     */
    public function stages(int $id)
    {
        return $this->render('prostage/stages.html.twig', [
            'id_stage' => $id,
        ]);
    }
}
