<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
    	// création d'un générateur de données Faker
		$faker = \Faker\Factory::create('fr_FR');

		$formations = ['DUT Info', 'DUT GIM', 'Licence Pro Prog avancée', 'Licence Pro num', 'DUT GEA'];

		foreach ($formations as $formationNom) {
			$formation1 = new Formation();
			$formation1->setType($formationNom);
			$formation1->setDescription($faker->paragraph);
			$manager->persist($formation1);

			for ($i = 1; $i < 3; $i++)
			{

				$entreprise1 = new Entreprise();
				$entreprise1->setNom($faker->company);
				$entreprise1->setAdresse($faker->address);
				$entreprise1->setNumTel($faker->phoneNumber);
				$entreprise1->setSite($faker->url);

				$stage1 = new Stage();
				$stage1->setEntreprise($entreprise1);
				$stage1->addFormation($formation1);
				$stage1->setTitre($faker->sentence);
				$stage1->setDescription($faker->paragraph);
				$stage1->setDateDebut($faker->dateTimeBetween($startDate = 'now', $endDate = '+ 8 month', $timezone = 'Europe/Paris'));
				$stage1->setDateFin($faker->dateTimeBetween($startDate = 'now', $endDate = '+ 8 month', $timezone = 'Europe/Paris'));
				$stage1->setContact($faker->email);

				$manager->persist($entreprise1);

				$manager->persist($stage1);
			}
		}

		

		$manager->flush();
	}
}
