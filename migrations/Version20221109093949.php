<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109093949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administrateurs (id INT AUTO_INCREMENT NOT NULL, id_compte_id INT NOT NULL, identifiant VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B5ED4E1372F0DA07 (id_compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comptes (id INT AUTO_INCREMENT NOT NULL, creation_compte DATETIME NOT NULL, email VARCHAR(255) NOT NULL, envoi_email DATETIME DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, email_verification TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT DEFAULT NULL, id_promotion_id INT DEFAULT NULL, id_enseigant_id INT DEFAULT NULL, date DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, nom_matiere VARCHAR(255) DEFAULT NULL, INDEX IDX_FDCA8C9C8CEBACA0 (id_salle_id), INDEX IDX_FDCA8C9C305C84E6 (id_promotion_id), INDEX IDX_FDCA8C9CF88F188A (id_enseigant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_eleves (cours_id INT NOT NULL, eleves_id INT NOT NULL, INDEX IDX_57BB18D97ECF78B0 (cours_id), INDEX IDX_57BB18D9C2140342 (eleves_id), PRIMARY KEY(cours_id, eleves_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleves (id INT AUTO_INCREMENT NOT NULL, id_promotion_id INT DEFAULT NULL, id_compte_id INT NOT NULL, identifiant VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_naissance DATE DEFAULT NULL, telephone VARCHAR(10) DEFAULT NULL, INDEX IDX_383B09B1305C84E6 (id_promotion_id), UNIQUE INDEX UNIQ_383B09B172F0DA07 (id_compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignants (id INT AUTO_INCREMENT NOT NULL, id_compte_id INT DEFAULT NULL, identifiant VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_naissance DATE DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_BA5EFB5A72F0DA07 (id_compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissements (id INT AUTO_INCREMENT NOT NULL, nom_etablissement VARCHAR(255) NOT NULL, ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres (id INT AUTO_INCREMENT NOT NULL, nom_matiere VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres_enseignants (matieres_id INT NOT NULL, enseignants_id INT NOT NULL, INDEX IDX_87C9A2AD82350831 (matieres_id), INDEX IDX_87C9A2AD7CF12A69 (enseignants_id), PRIMARY KEY(matieres_id, enseignants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotions (id INT AUTO_INCREMENT NOT NULL, id_etablissement_id INT NOT NULL, nom_promotion VARCHAR(255) NOT NULL, annee INT DEFAULT NULL, INDEX IDX_EA1B30341CE947F9 (id_etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salles (id INT AUTO_INCREMENT NOT NULL, id_etablissement_id INT NOT NULL, nom_salle VARCHAR(255) NOT NULL, caracteristique VARCHAR(255) DEFAULT NULL, INDEX IDX_799D45AA1CE947F9 (id_etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, usernaime VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649EE93E217 (usernaime), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrateurs ADD CONSTRAINT FK_B5ED4E1372F0DA07 FOREIGN KEY (id_compte_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C8CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C305C84E6 FOREIGN KEY (id_promotion_id) REFERENCES promotions (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CF88F188A FOREIGN KEY (id_enseigant_id) REFERENCES enseignants (id)');
        $this->addSql('ALTER TABLE cours_eleves ADD CONSTRAINT FK_57BB18D97ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_eleves ADD CONSTRAINT FK_57BB18D9C2140342 FOREIGN KEY (eleves_id) REFERENCES eleves (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B1305C84E6 FOREIGN KEY (id_promotion_id) REFERENCES promotions (id)');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B172F0DA07 FOREIGN KEY (id_compte_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE enseignants ADD CONSTRAINT FK_BA5EFB5A72F0DA07 FOREIGN KEY (id_compte_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE matieres_enseignants ADD CONSTRAINT FK_87C9A2AD82350831 FOREIGN KEY (matieres_id) REFERENCES matieres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matieres_enseignants ADD CONSTRAINT FK_87C9A2AD7CF12A69 FOREIGN KEY (enseignants_id) REFERENCES enseignants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B30341CE947F9 FOREIGN KEY (id_etablissement_id) REFERENCES etablissements (id)');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AA1CE947F9 FOREIGN KEY (id_etablissement_id) REFERENCES etablissements (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrateurs DROP FOREIGN KEY FK_B5ED4E1372F0DA07');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C8CEBACA0');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C305C84E6');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CF88F188A');
        $this->addSql('ALTER TABLE cours_eleves DROP FOREIGN KEY FK_57BB18D97ECF78B0');
        $this->addSql('ALTER TABLE cours_eleves DROP FOREIGN KEY FK_57BB18D9C2140342');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B1305C84E6');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B172F0DA07');
        $this->addSql('ALTER TABLE enseignants DROP FOREIGN KEY FK_BA5EFB5A72F0DA07');
        $this->addSql('ALTER TABLE matieres_enseignants DROP FOREIGN KEY FK_87C9A2AD82350831');
        $this->addSql('ALTER TABLE matieres_enseignants DROP FOREIGN KEY FK_87C9A2AD7CF12A69');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B30341CE947F9');
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AA1CE947F9');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE administrateurs');
        $this->addSql('DROP TABLE comptes');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE cours_eleves');
        $this->addSql('DROP TABLE eleves');
        $this->addSql('DROP TABLE enseignants');
        $this->addSql('DROP TABLE etablissements');
        $this->addSql('DROP TABLE matieres');
        $this->addSql('DROP TABLE matieres_enseignants');
        $this->addSql('DROP TABLE promotions');
        $this->addSql('DROP TABLE salles');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
