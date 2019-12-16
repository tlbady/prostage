<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;


class ProstageController extends AbstractController
{
    /**
     * @Route("/", name="prostage")
     */
    public function index()
    {
        $listeStages = $this->getDoctrine()->getRepository(Stage::class)->findAll();
        
        return $this->render('prostage/index.html.twig', [
            "listeStages" => $listeStages
        ]);
    }

    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function entreprises()
    {
        $listeEntreprises = $this->getDoctrine()->getRepository(Entreprise::class)->findBy(array(), array('nom' => 'ASC'));
        
        return $this->render('prostage/entreprises.html.twig', [
            "listeEntreprises" => $listeEntreprises
        ]);
    }

    /**
     * @Route("/entreprises/{id}", name="entreprise_stages")
     */
    public function entreprise_stages($id)
    {
        $entreprise = $this->getDoctrine()->getRepository(Entreprise::class)->find($id);
        $listeStages = $this->getDoctrine()->getRepository(Stage::class)->findByEntreprise($id);
        
        return $this->render('prostage/entreprise_stages.html.twig', [
            "entreprise" => $entreprise,
            "listeStages" => $listeStages
        ]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function formations()
    {
        $listeFormations = $this->getDoctrine()->getRepository(Formation::class)->findBy(array(), array('type' => 'ASC'));
        
        return $this->render('prostage/formations.html.twig', [
            "listeFormations" => $listeFormations
        ]);
    }

    /**
     * @Route("/formations/{id}", name="formation_stages")
     */
    public function formation_stages($id)
    {
        $formation = $this->getDoctrine()->getRepository(Formation::class)->find($id);

        $listeStages = $this->getDoctrine()->getRepository(Stage::class)->findById($formation->getStages()->getValues());
        
        return $this->render('prostage/formation_stages.html.twig', [
            "formation" => $formation,
            "listeStages" => $listeStages
        ]);
    }

    /**
     * @Route("/stages/{id}", name="stages")
     */
    public function stages(int $id)
    {
        $stage = $this->getDoctrine()->getRepository(Stage::class)->find($id);
        return $this->render('prostage/stages.html.twig', [
            'stage' => $stage
        ]);
    }
}
