<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120101658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (Id_adresse INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) DEFAULT NULL, adresse_complementaire VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(5) DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, statut TINYINT(1) NOT NULL, telephone_suplementaire VARCHAR(20) DEFAULT NULL, Id_fournisseur INT DEFAULT NULL, Id_user INT DEFAULT NULL, INDEX IDX_C35F0816E3E87F1D (Id_fournisseur), INDEX IDX_C35F0816C90EF3D7 (Id_user), PRIMARY KEY(Id_adresse)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (Id_commande INT AUTO_INCREMENT NOT NULL, date_commande DATE NOT NULL, statut_commande VARCHAR(50) NOT NULL, montant_total NUMERIC(15, 2) NOT NULL, mode_paiement TINYINT(1) NOT NULL, reduction NUMERIC(15, 2) DEFAULT NULL, date_paiement DATE DEFAULT NULL, reference_facture VARCHAR(50) NOT NULL, date_facture DATE NOT NULL, Id_user INT DEFAULT NULL, INDEX IDX_6EEAA67DC90EF3D7 (Id_user), PRIMARY KEY(Id_commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_commande (quantite_commander INT NOT NULL, prix_unitaire NUMERIC(15, 2) NOT NULL, Id_produit INT NOT NULL, Id_commande INT NOT NULL, INDEX IDX_98344FA6B8654687 (Id_produit), INDEX IDX_98344FA6B8ADC53F (Id_commande), PRIMARY KEY(Id_produit, Id_commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_livraison (quantite_livrer INT NOT NULL, Id_produit INT NOT NULL, Id_livraison INT NOT NULL, INDEX IDX_B7FB4AAAB8654687 (Id_produit), INDEX IDX_B7FB4AAA3E08F8C0 (Id_livraison), PRIMARY KEY(Id_produit, Id_livraison)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE echange (Id_echange INT AUTO_INCREMENT NOT NULL, date_echange DATE NOT NULL, sujet_echange VARCHAR(50) NOT NULL, type_echange VARCHAR(255) DEFAULT NULL, description_echange VARCHAR(255) DEFAULT NULL, Id_user INT DEFAULT NULL, Id_employe INT DEFAULT NULL, INDEX IDX_B577E3BFC90EF3D7 (Id_user), INDEX IDX_B577E3BF69C47919 (Id_employe), PRIMARY KEY(Id_echange)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (Id_employe INT AUTO_INCREMENT NOT NULL, nom_employe VARCHAR(255) NOT NULL, reference_employe VARCHAR(255) NOT NULL, telephone_employe VARCHAR(50) NOT NULL, email_employe VARCHAR(255) DEFAULT NULL, Id_service INT DEFAULT NULL, INDEX IDX_F804D3B9705D3072 (Id_service), PRIMARY KEY(Id_employe)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (Id_fournisseur INT AUTO_INCREMENT NOT NULL, nom_fournisseur VARCHAR(50) NOT NULL, telephone_fournisseur VARCHAR(20) NOT NULL, siret VARCHAR(14) NOT NULL, reference_fournisseur VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, type VARCHAR(10) NOT NULL, PRIMARY KEY(Id_fournisseur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_produit (Id_image_produit INT AUTO_INCREMENT NOT NULL, libelle_image VARCHAR(255) NOT NULL, Id_produit INT DEFAULT NULL, INDEX IDX_BCB5BBFBB8654687 (Id_produit), PRIMARY KEY(Id_image_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (Id_livraison INT AUTO_INCREMENT NOT NULL, date_edition DATE DEFAULT NULL, statut_livraison TINYINT(1) NOT NULL, reference_livraison VARCHAR(50) NOT NULL, Id_commande INT DEFAULT NULL, INDEX IDX_A60C9F1FB8ADC53F (Id_commande), PRIMARY KEY(Id_livraison)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (Id_produit INT AUTO_INCREMENT NOT NULL, libelle_court VARCHAR(50) NOT NULL, description_long VARCHAR(255) NOT NULL, prix_achat_ht NUMERIC(15, 2) NOT NULL, statut_produit TINYINT(1) DEFAULT NULL, stock_produit VARCHAR(50) DEFAULT NULL, marque VARCHAR(255) DEFAULT NULL, libelle_modele VARCHAR(255) NOT NULL, Id_fournisseur INT DEFAULT NULL, Id_rubrique INT DEFAULT NULL, INDEX IDX_29A5EC27E3E87F1D (Id_fournisseur), INDEX IDX_29A5EC2759E36A3E (Id_rubrique), PRIMARY KEY(Id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (Id_role INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(255) NOT NULL, niveau_role VARCHAR(50) NOT NULL, PRIMARY KEY(Id_role)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rubrique (Id_rubrique INT AUTO_INCREMENT NOT NULL, libelle_image VARCHAR(255) NOT NULL, label_rubrique VARCHAR(255) NOT NULL, Id_rubrique_id_sous_rubrique INT DEFAULT NULL, INDEX IDX_8FA4097CB1BE16BE (Id_rubrique_id_sous_rubrique), PRIMARY KEY(Id_rubrique)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (Id_service INT AUTO_INCREMENT NOT NULL, nom_service VARCHAR(255) NOT NULL, telephone_service VARCHAR(20) NOT NULL, email_service VARCHAR(255) NOT NULL, Id_role INT DEFAULT NULL, INDEX IDX_E19D9AD213F4AFF4 (Id_role), PRIMARY KEY(Id_service)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (Id_user INT AUTO_INCREMENT NOT NULL, nom_user VARCHAR(255) NOT NULL, prenom_user VARCHAR(50) NOT NULL, telephone_user VARCHAR(50) NOT NULL, email_user VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, coef NUMERIC(10, 2) NOT NULL, siret VARCHAR(14) DEFAULT NULL, reference VARCHAR(20) NOT NULL, Id_employe INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649AEA34913 (reference), INDEX IDX_8D93D64969C47919 (Id_employe), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(Id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816E3E87F1D FOREIGN KEY (Id_fournisseur) REFERENCES fournisseur (Id_fournisseur)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816C90EF3D7 FOREIGN KEY (Id_user) REFERENCES user (Id_user)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DC90EF3D7 FOREIGN KEY (Id_user) REFERENCES user (Id_user)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA6B8654687 FOREIGN KEY (Id_produit) REFERENCES produit (Id_produit)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA6B8ADC53F FOREIGN KEY (Id_commande) REFERENCES commande (Id_commande)');
        $this->addSql('ALTER TABLE detail_livraison ADD CONSTRAINT FK_B7FB4AAAB8654687 FOREIGN KEY (Id_produit) REFERENCES produit (Id_produit)');
        $this->addSql('ALTER TABLE detail_livraison ADD CONSTRAINT FK_B7FB4AAA3E08F8C0 FOREIGN KEY (Id_livraison) REFERENCES livraison (Id_livraison)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFC90EF3D7 FOREIGN KEY (Id_user) REFERENCES user (Id_user)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BF69C47919 FOREIGN KEY (Id_employe) REFERENCES employe (Id_employe)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9705D3072 FOREIGN KEY (Id_service) REFERENCES service (Id_service)');
        $this->addSql('ALTER TABLE image_produit ADD CONSTRAINT FK_BCB5BBFBB8654687 FOREIGN KEY (Id_produit) REFERENCES produit (Id_produit)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FB8ADC53F FOREIGN KEY (Id_commande) REFERENCES commande (Id_commande)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27E3E87F1D FOREIGN KEY (Id_fournisseur) REFERENCES fournisseur (Id_fournisseur)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2759E36A3E FOREIGN KEY (Id_rubrique) REFERENCES rubrique (Id_rubrique)');
        $this->addSql('ALTER TABLE rubrique ADD CONSTRAINT FK_8FA4097CB1BE16BE FOREIGN KEY (Id_rubrique_id_sous_rubrique) REFERENCES rubrique (Id_rubrique)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD213F4AFF4 FOREIGN KEY (Id_role) REFERENCES role (Id_role)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64969C47919 FOREIGN KEY (Id_employe) REFERENCES employe (Id_employe)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816E3E87F1D');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816C90EF3D7');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DC90EF3D7');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA6B8654687');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA6B8ADC53F');
        $this->addSql('ALTER TABLE detail_livraison DROP FOREIGN KEY FK_B7FB4AAAB8654687');
        $this->addSql('ALTER TABLE detail_livraison DROP FOREIGN KEY FK_B7FB4AAA3E08F8C0');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFC90EF3D7');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BF69C47919');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9705D3072');
        $this->addSql('ALTER TABLE image_produit DROP FOREIGN KEY FK_BCB5BBFBB8654687');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FB8ADC53F');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27E3E87F1D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2759E36A3E');
        $this->addSql('ALTER TABLE rubrique DROP FOREIGN KEY FK_8FA4097CB1BE16BE');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD213F4AFF4');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64969C47919');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE detail_commande');
        $this->addSql('DROP TABLE detail_livraison');
        $this->addSql('DROP TABLE echange');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE image_produit');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE rubrique');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
