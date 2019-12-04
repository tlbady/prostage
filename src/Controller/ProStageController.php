<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Stage;

class ProstageController extends AbstractController
{
    /**
     * @Route("/", name="prostage")
     */
    public function index()
    {
        $listeStages = $this->getDoctrine()->getRepository(Stage::class)->recupererListeStages();
        
        return $this->render('prostage/index.html.twig', [
            "listeStages" => $listeStages
        ]);
    }

    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function entreprises()
    {
        $listeStages = $this->getDoctrine()->getRepository(Stage::class)->recupererStagesParEntreprise();
        
        return $this->render('prostage/entreprises.html.twig', [
            "listeStages" => $listeStages
        ]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function formations()
    {
        $listeStages = $this->getDoctrine()->getRepository(Stage::class)->recupererStagesParFormation();
        
        return $this->render('prostage/formations.html.twig', [
            "listeStages" => $listeStages
        ]);
    }

    /**
     * @Route("/stages/{id}", name="stages")
     */
    public function stages(int $id)
    {
        $stage = $this->getDoctrine()->getRepository(Stage::class)->recupererStage($id);
        return $this->render('prostage/stages.html.twig', [
            'stage' => $stage[0]
        ]);
    }
}
