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
        $listeStages = [
            1 => ["nom" => "Stage de développeur", "entreprise" => "Total", "formation" => "DUT Info", "duree" => "15 Avril au 18 Mai"],
            2 => ["nom" => "Stage de développeur web", "entreprise" => "V&B", "formation" => "DUT Info", "duree" => "15 Avril au 18 Mai"]
        ];
        return $this->render('prostage/index.html.twig', [
            "listeStages" => $listeStages
        ]);
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
        $listeStages = [
            1 => ["nom" => "Stage de développeur", "entreprise" => "Total", "formation" => "DUT Info", "duree" => "15 Avril au 18 Mai"],
            2 => ["nom" => "Stage de développeur web", "entreprise" => "V&B", "formation" => "DUT Info", "duree" => "15 Avril au 18 Mai"]
        ];
        return $this->render('prostage/stages.html.twig', [
            'id_stage' => $id,
            'stage' => $listeStages[$id]
        ]);
    }
}
