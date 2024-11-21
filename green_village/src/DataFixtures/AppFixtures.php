<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Adresse;
use App\Entity\Employe;
use App\Entity\Produit;
use App\Entity\Service;
use App\Entity\Rubrique;
use App\Entity\Fournisseur;
use App\Entity\ImageProduit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $users = [];
        $fournisseurs = [];
        $services = [];

        $roles = [
            ['nom' => 'Commercial', 'niveau' => 'niveau_4'],
            ['nom' => 'Manager', 'niveau' => 'niveau_2'],
            ['nom' => 'Utilisateur', 'niveau' => 'niveau_5'],
            ['nom' => 'Administrateur', 'niveau' => 'niveau_1'],
        ];

        foreach ($roles as $roleData) {
            $role = new Role();
            $role->setNomRole($roleData['nom']);
            $role->setNiveauRole($roleData['niveau']);
            $manager->persist($role);
        }

        $roleUtilisateur = $manager->getRepository(Role::class)->findOneBy(['nomRole' => 'Utilisateur']);

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setNomUser($faker->lastName());
            $user->setPrenomUser($faker->firstName());
            $user->setTelephoneUser($faker->numerify('06########'));
            $user->setEmailUser($faker->unique()->safeEmail());
            $user->setEmail($faker->unique()->email());
            $password = $this->passwordHasher->hashPassword($user, 'password123');
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $user->setCoef(1.5);
            $user->setSiret($faker->optional()->regexify('[0-9]{14}'));
            $user->setReference('USER-' . uniqid());

            $manager->persist($user);
            $users[] = $user;
        }

        $manager->flush();

        $fournisseurType = [
            'Constructeur',
            'Importateur'
        ];
        
        $fournisseurType = $faker->randomElement($fournisseurType);
        
        for ($i = 0; $i < 5; $i++) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNomFournisseur($faker->company());
            $fournisseur->setTelephoneFournisseur($faker->numerify('06########'));
            $fournisseur->setSiret($faker->numerify('##############'));
            $fournisseur->setReferenceFournisseur($faker->unique()->bothify('REF-####-??'));
            $fournisseur->setEmail($faker->email());
            $fournisseur->setType($fournisseurType);
            $manager->persist($fournisseur);
            $fournisseurs[] = $fournisseur;
        }
        

        for ($i = 0; $i < 25; $i++) {
            $adresse = new Adresse();
            $adresse->setAdresse($faker->streetAddress());
            $adresse->setAdresseComplementaire($faker->secondaryAddress());
            $adresse->setCodePostal($faker->postcode());
            $adresse->setVille($faker->city());
            $adresse->setStatut($faker->boolean());
            $adresse->setTelephoneSupplementaire((''));

            if ($faker->boolean(50)) {
                $adresse->setFournisseur($faker->randomElement($fournisseurs));
            } else {
                $adresse->setUser($faker->randomElement($users));
            }

            $manager->persist($adresse);
        }


        $roleCommercial = $manager->getRepository(Role::class)->findOneBy(['nomRole' => 'Commercial']);
        $roleManager = $manager->getRepository(Role::class)->findOneBy(['nomRole' => 'Manager']);
        $roleAdministrateur = $manager->getRepository(Role::class)->findOneBy(['nomRole' => 'Administrateur']);

        $serviceNames = [
            'Service commercial professionnel' => $roleCommercial,
            'Service commercial particulier' => $roleCommercial,
            'Service gestion' => $roleAdministrateur,
            'Service après vente' => $roleManager,
            'Service comptabilité' => $roleManager
        ];

        foreach ($serviceNames as $serviceName => $role) {
            $service = new Service();
            $service->setNomService($serviceName);
            $service->setTelephoneService($faker->numerify('06########'));
            $email = $faker->optional()->safeEmail();
            $service->setEmailService($email ?: $faker->email());
            $service->setRole($role);

            $manager->persist($service);
            $services[] = $service;
        }


        for ($i = 0; $i < 20; $i++) {
            $employe = new Employe();
            $employe->setNomEmploye($faker->lastName());
            $employe->setTelephoneEmploye($faker->numerify('06########'));
            $employe->setEmailEmploye($faker->optional()->safeEmail());
            $employe->setReferenceEmploye('EMP-' . strtoupper($faker->bothify('??###')));
            $randomService = $services[array_rand($services)];
            $employe->setService($randomService);

            $manager->persist($employe);
        }

        $rubriques = [
            'Instruments à cordes',
            'Instruments à vent',
            'Instruments à percussion',
            'Instruments électroniques'
        ];
        
        $rubriqueObjects = [];
        
        foreach ($rubriques as $rubriqueName) {
            $rubrique = new Rubrique();
            $rubrique->setLabelRubrique($rubriqueName);
            $rubrique->setLibelleImage($faker->word());
            $manager->persist($rubrique);
            $rubriqueObjects[] = $rubrique;
        }
        
        $sousRubriques = [
            'Guitares' => $rubriqueObjects[0],
            'Violons' => $rubriqueObjects[0],
            'Flûtes' => $rubriqueObjects[1],
            'Trombones' => $rubriqueObjects[1],
            'Batteries' => $rubriqueObjects[2],
            'Synthétiseurs' => $rubriqueObjects[3]
        ];
        
        $sousRubriqueObjects = [];
        
        foreach ($sousRubriques as $sousRubriqueName => $parentRubrique) {
            $sousRubrique = new Rubrique();
            $sousRubrique->setLabelRubrique($sousRubriqueName);
            $sousRubrique->setLibelleImage($faker->word());
            $sousRubrique->setParentRubrique($parentRubrique);
            $manager->persist($sousRubrique);
            $sousRubriqueObjects[$sousRubriqueName] = $sousRubrique;
        }
        
        $produits = [
            ['libelleCourt' => 'Guitare électrique', 'rubrique' => $sousRubriqueObjects['Guitares'], 'marque' => 'Fender'],
            ['libelleCourt' => 'Guitare acoustique', 'rubrique' => $sousRubriqueObjects['Guitares'], 'marque' => 'Gibson'],
            ['libelleCourt' => 'Violon', 'rubrique' => $sousRubriqueObjects['Violons'], 'marque' => 'Stradivarius'],
            ['libelleCourt' => 'Flûte traversière', 'rubrique' => $sousRubriqueObjects['Flûtes'], 'marque' => 'Yamaha'],
            ['libelleCourt' => 'Trombone', 'rubrique' => $sousRubriqueObjects['Trombones'], 'marque' => 'Yamaha'],
            ['libelleCourt' => 'Batterie acoustique', 'rubrique' => $sousRubriqueObjects['Batteries'], 'marque' => 'Pearl'],
            ['libelleCourt' => 'Synthétiseur', 'rubrique' => $sousRubriqueObjects['Synthétiseurs'], 'marque' => 'Yamaha']
        ];
        
        foreach ($produits as $produitData) {
            $produit = new Produit();
            $produit->setLibelleCourt($produitData['libelleCourt']);
            $produit->setDescriptionLong($faker->paragraph());
            $produit->setPrixAchatHt($faker->randomFloat(2, 50, 1000));
            $produit->setMarque($produitData['marque']);
            $produit->setStockProduit($faker->numberBetween(0, 50));
            $produit->setLibelleModele($faker->word());
            $produit->setRubrique($produitData['rubrique']);
            $produit->setFournisseur($faker->randomElement($fournisseurs));
        
            $manager->persist($produit);
        }
        
        $produitRepository = $manager->getRepository(Produit::class);
        $produits = $produitRepository->findAll();
        
        foreach ($produits as $produit) {
            $nombreImages = $faker->numberBetween(1, 3);
        
            for ($i = 0; $i < $nombreImages; $i++) {
                $imageProduit = new ImageProduit();
                $imageProduit->setLibelleImage($faker->unique()->lexify('image-?????.jpg'));
                $imageProduit->setProduit($produit);
                $manager->persist($imageProduit);
            }
        }




        $manager->flush();
    }
}
