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
            'Instruments à cordes' => 'instrumentacordes.png',
            'Instruments à vent' => 'instrumentavent.png',
            'Instruments à percussion' => 'instrumentapercussion.png',
            'Instruments électroniques' => 'instrumenteclectronique.png',
        ];

        $rubriqueObjects = [];

        foreach ($rubriques as $rubriqueName => $imageFileName) {
            $rubrique = new Rubrique();
            $rubrique->setLabelRubrique($rubriqueName);
            $rubrique->setLibelleImage($imageFileName);
            $manager->persist($rubrique);
            $rubriqueObjects[] = $rubrique;
        }


        $sousRubriques = [
            'Guitares' => ['parent' => $rubriqueObjects[0], 'image' => 'guitares.png'],
            'Violons' => ['parent' => $rubriqueObjects[0], 'image' => 'violons.png'],
            'Flûtes' => ['parent' => $rubriqueObjects[1], 'image' => 'flutes.png'],
            'Trombones' => ['parent' => $rubriqueObjects[1], 'image' => 'trombones.png'],
            'Batteries' => ['parent' => $rubriqueObjects[2], 'image' => 'batteries.png'],
            'Synthétiseurs' => ['parent' => $rubriqueObjects[3], 'image' => 'synthetiseurs.png']
        ];

        $sousRubriqueObjects = [];

        foreach ($sousRubriques as $sousRubriqueName => $data) {
            $sousRubrique = new Rubrique();
            $sousRubrique->setLabelRubrique($sousRubriqueName);
            $sousRubrique->setLibelleImage($data['image']); 
            $sousRubrique->setParentRubrique($data['parent']);
            $manager->persist($sousRubrique);
            $sousRubriqueObjects[$sousRubriqueName] = $sousRubrique;
        }


        $produits = [
            [
                'libelleCourt' => 'Harley Benton ST-20 BK Standard Series',
                'prix' => '880',
                'rubrique' => $sousRubriqueObjects['Guitares'],
                'marque' => 'Harley Benton',
                'libelleModele' => 'ST-20 BK Standard Series',
                'caracteristique' => [
                    'Corps' => 'Peuplier',
                    'Manche' => 'Erable',
                    'Touche' => 'Roseacer',
                    'Repères' => 'Points',
                    'Profil du manche' => 'Modern C',
                    'Rayon de la touche' => '305 mm',
                    'Frettes' => '22',
                    'Diapason' => '648 mm',
                    'Largeur au sillet' => '42 mm',
                    'Barre de réglage (Truss Rod)' => 'Double action',
                    'Micros' => '3 micros simple bobinage style ST',
                    'Réglages' => '1 réglage de volume, 2 réglages de tonalité',
                    'Sélecteur' => '5 positions',
                    'Accastillage' => 'Chromé',
                    'Vibrato' => 'Synchronisé',
                    'Mécaniques' => 'Fermées',
                    'Cordes' => '.009-.042',
                    'Couleur' => 'Noir haute brillance',
                ],
                'images' => [ 
                    'HarleyBentonST-20BKStandardSeries.png',
                    'HarleyBentonST-20BKStandardSeries2.png',
                    'HarleyBentonST-20BKStandardSeries3.png',
                    'HarleyBentonST-20BKStandardSeries4.png',
                    'HarleyBentonST-20BKStandardSeries5.png'
                ]
            ],
            
            [
                'libelleCourt' => 'Fender CC-60SCE Nat WN',
                'prix' => 259,
                'rubrique' => $sousRubriqueObjects['Guitares'], 
                'marque' => 'Fender',
                'libelleModele' => 'CC-60SCE Nat WN',
                'caracteristique' => [
                    'Design' => 'Classique',
                    'Forme' => 'Concert',
                    'Pan coupé' => 'Oui',
                    'Table' => 'Epicéa massif',
                    'Barrage' => 'En X sculpté (scallopé)',
                    'Fond et éclisses' => 'Acajou',
                    'Manche' => 'Acajou',
                    'Touche' => 'Noyer',
                    'Frettes' => '20',
                    'Largeur au sillet' => '43 mm',
                    'Diapason' => '643 mm',
                    'Accastillage' => 'Chromé',
                    'Electronique' => 'Fishman CD',
                    'Couleur' => 'Naturel'
                ],
                'images' => [
                    'FenderCC-60SCENatWN.png',
                    'FenderCC-60SCENatWN2.png',
                    'FenderCC-60SCENatWN3.png'
                ]
            ],

            [
                'libelleCourt' => 'Edgar Russ Ysaye Guarneri 1740',
                'prix' => 36490,
                'rubrique' => $sousRubriqueObjects['Violons'], 
                'marque' => 'Edgar Russ',
                'libelleModele' => 'Sound of Cremona',
                'caracteristique' => [
                    'Référencé depuis' => 'Mars 2024',
                    'Numéro d\'article' => '586428',
                    'Conditionnement (UVC)' => '1 Pièce(s)',
                    'Archer inclus' => 'Non',
                    'Étui inclus' => 'Non',
                    'Touche' => 'Ebène',
                    'Fabriqué sans bois tropicaux' => 'Non',
                    'Dos flammé' => 'Oui',
                    'Cordier avec vis d\'accordage fin' => 'Non',
                    'Accordage fin pour corde de Mi' => 'Oui'
                ],
                'images' => [
                    'EdgarRussYsayeGuarneri1740.png',
                    'EdgarRussYsayeGuarneri17402.png',
                    'EdgarRussYsayeGuarneri17403.png'
                ]
                ],

                [
                    'libelleCourt' => 'Millenium Focus 22 Drum Set Red',
                    'prix' => 399,
                    'rubrique' => $sousRubriqueObjects['Batteries'],
                    'marque' => 'Millenium',
                    'libelleModele' => 'Focus 22 Drum Set',
                    'caracteristique' => [
                        'Série' => 'Focus',
                        'Adaptée pour' => 'Débutants ambitieux',
                        'Grosse caisse' => '22\"x16\"',
                        'Tom 1' => '10\"x08\"',
                        'Tom 2' => '12\"x09\"',
                        'Stand tom' => '16\"x14\"',
                        'Caisse claire' => '14\"x5,5\" en bois',
                        'Finition' => 'Rhodoïd',
                        'Couleur' => 'Rouge',
                        'Accessoires inclus' => 'Paire de baguettes',
                        'Coussin atténuateur' => 'Pour grosse caisse',
                        'Anneaux atténuateurs' => 'Pour toms et caisse claire',
                        'Matériel fourni' => 'Pied droit de cymbale, Pédale de charleston, Pied de caisse claire, Pédale de grosse caisse, Supports de tom, Siège'
                    ],
                    'images' => [
                        'MilleniumFocus22DrumSetRed.png',
                        'MilleniumFocus22DrumSetRed2.png',
                        'MilleniumFocus22DrumSetRed3.png'
                    ]
                    ],
                    [
                        'libelleCourt' => 'Yamaha YSL-356 G Bb/F-Trombone',
                        'prix' => 1549,
                        'rubrique' => $sousRubriqueObjects['Trombones'], 
                        'marque' => 'Yamaha',
                        'libelleModele' => 'YSL-356 G Bb/F-Trombone',
                        'caracteristique' => [
                            'Corps' => 'Laiton doré avec vernis doré',
                            'Rotor' => 'De quarte standard',
                            'Construction' => 'Closed Wrap',
                            'Double perce' => '12,7 - 13,34 mm',
                            'Diamètre du pavillon' => '204,4 mm',
                            'Coulisse' => 'En maillechort',
                            'Étui et embouchure' => 'Étui rigide et embouchure 48S incl.'
                        ],
                        'images' => [
                            'YamahaYSL-356G Bb-F-Trombone.png',
                            'YamahaYSL-356G Bb-F-Trombone2.png',
                            'YamahaYSL-356G Bb-F-Trombone3.png'
                        ]
                        ],
                        [
                            'libelleCourt' => 'Muramatsu EX-III-RCE Flute',
                            'prix' => 3499,
                            'rubrique' => $sousRubriqueObjects['Flûtes'],
                            'marque' => 'Muramatsu',
                            'libelleModele' => 'EX-III-RCE',
                            'caracteristique' => [
                                'Type' => 'Flûte traversière',
                                'Tête' => 'En argent massif',
                                'Plateaux' => 'Creux',
                                'Mi mécanique' => 'Oui',
                                'Sol décalé' => 'Oui',
                                'Corps et mécanique' => 'Argentés',
                                'Accessoires' => 'Étui et écouvillon incl.'
                            ],
                            'images' => [
                                'MuramatsuEX-III-RCEFlute.png',
                                'MuramatsuEX-III-RCEFlute2.png',
                                'MuramatsuEX-III-RCEFlute3.png'
                            ]
                            ],
                            [
                                'libelleCourt' => 'Arturia MicroFreak',
                                'prix' => 266,
                                'rubrique' => $sousRubriqueObjects['Synthétiseurs'],
                                'marque' => 'Arturia',
                                'libelleModele' => 'MicroFreak',
                                'caracteristique' => [
                                    'Touches' => '25 touches tactiles sensibles à la vélocité avec aftertouch polyphonique',
                                    'Oscillateur' => 'Numérique avec des techniques telles que Karplus Strong, Harmonic OSC, Superwave et Texturer',
                                    'Filtre' => 'Variable d\'état analogique (-12 dB / oct.) avec passe-bas, passe-bande, passe-haut',
                                    'LFO' => '6 modes de vibration',
                                    'Enveloppes' => '2 générateurs',
                                    'Matrice de modulation' => '5 sources et 7 destinations',
                                    'Arpégiateur' => 'Oui',
                                    'Séquenceur' => 'Pas à pas avec 4 pistes d\'automation et paramètres aléatoires',
                                    'Mode' => 'Paraphonique',
                                    'Écran' => 'OLED',
                                    'Sortie ligne' => 'Jack 6,3 mm',
                                    'Sorties CV/Gate/Pressure' => 'Mini Jack 3,5 mm',
                                    'Entrée/sortie Clock' => 'Mini Jack 3,5 mm',
                                    'Entrée/sortie MIDI' => 'Mini Jack stéréo 3,5 mm',
                                    'Port USB' => 'Oui',
                                    'Dimensions' => '311 x 233 x 55 mm',
                                    'Poids' => '1,02 kg',
                                    'Bloc d\'alimentation' => '12V DC inclus',
                                ],
                                'images' => [
                                    'ArturiaMicroFreak.png',
                                    'ArturiaMicroFreak2.png',
                                    'ArturiaMicroFreak3.png',
                                ],
                            ],
                            

            
        ];

        foreach ($produits as $produitData) {
            $produit = new Produit();
            $produit->setLibelleCourt($produitData['libelleCourt']);
            $produit->setCaracteristiques($produitData['caracteristique']);
            $produit->setPrixAchatHt($produitData['prix']);
            $produit->setMarque($produitData['marque']);
            $produit->setStockProduit($faker->numberBetween(0, 50));
            $produit->setLibelleModele($produitData['libelleModele']);
            $produit->setRubrique($produitData['rubrique']);
            $produit->setFournisseur($faker->randomElement($fournisseurs));
            $manager->persist($produit);
        
            foreach ($produitData['images'] as $imagePath) {
                $imageProduit = new ImageProduit();
                
                // Vérifiez ici si $imagePath est valide
                if (is_string($imagePath)) {
                    $imageProduit->setLibelleImage($imagePath);
                    $imageProduit->setProduit($produit);
                    $manager->persist($imageProduit);
                } else {
                    throw new \Exception("Chemin d'image invalide : " . print_r($imagePath, true));
                }
            }
        }
        
        $manager->flush();

    }
}