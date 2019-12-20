<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;


class ProstageController extends AbstractController
{
    /**
     * @Route("/", name="prostage")
     */
    public function index(StageRepository $repositoryStage) // Utilisation du mécanisme d'injection de dépendances
    {
        $listeStages = $repositoryStage->findAll();
        
        return $this->render('prostage/index.html.twig', [
            "listeStages" => $listeStages
        ]);
    }

    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function entreprises(EntrepriseRepository $repositoryEntreprise) // Utilisation du mécanisme d'injection de dépendances
    {
        $listeEntreprises = $repositoryEntreprise->findBy(array(), array('nom' => 'ASC'));
        
        return $this->render('prostage/entreprises.html.twig', [
            "listeEntreprises" => $listeEntreprises
        ]);
    }

    /**
     * @Route("/entreprises/{id}", name="entreprise_stages")
     */
    public function entreprise_stages(Entreprise $entreprise, StageRepository $repositoryStage) // Utilisation du mécanisme d'injection de dépendances
    // Symfony crée un objet Entreprise en utilisant l'objet dont l'id est passée dans l'url
    {
        $listeStages = $repositoryStage->findByEntreprise($entreprise);
        
        return $this->render('prostage/entreprise_stages.html.twig', [
            "entreprise" => $entreprise,
            "listeStages" => $listeStages
        ]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function formations(FormationRepository $repositoryFormation) // Utilisation du mécanisme d'injection de dépendances
    {
        $listeFormations = $repositoryFormation->findBy(array(), array('type' => 'ASC'));
        
        return $this->render('prostage/formations.html.twig', [
            "listeFormations" => $listeFormations
        ]);
    }

    /**
     * @Route("/formations/{id}", name="formation_stages")
     */
    public function formation_stages(Formation $formation, StageRepository $repositoryStage) // Utilisation du mécanisme d'injection de dépendances
    // Symfony crée un objet Formation en utilisant l'objet dont l'id est passée dans l'url
    {
        $listeStages = $repositoryStage->findById($formation->getStages()->getValues());
        
        return $this->render('prostage/formation_stages.html.twig', [
            "formation" => $formation,
            "listeStages" => $listeStages
        ]);
    }

    /**
     * @Route("/stages/{id}", name="stages")
     */
    public function stages(Stage $stage) // Utilisation du mécanisme d'injection de dépendances
    // Symfony crée un objet Stage en utilisant l'objet dont l'id est passée dans l'url
    {
        return $this->render('prostage/stages.html.twig', [
            'stage' => $stage
        ]);
    }
}
