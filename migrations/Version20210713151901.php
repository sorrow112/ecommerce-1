<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210713151901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD client_id INT DEFAULT NULL, ADD payement_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D868C0609 FOREIGN KEY (payement_id) REFERENCES payement (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D868C0609 ON commande (payement_id)');
        $this->addSql('ALTER TABLE document ADD produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76F347EFB ON document (produit_id)');
        $this->addSql('ALTER TABLE panier_achat ADD client_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier_achat ADD CONSTRAINT FK_F84ABEB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE panier_achat ADD CONSTRAINT FK_F84ABEB82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_F84ABEB19EB6921 ON panier_achat (client_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F84ABEB82EA2E54 ON panier_achat (commande_id)');
        $this->addSql('ALTER TABLE payement ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payement ADD CONSTRAINT FK_B20A788519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_B20A788519EB6921 ON payement (client_id)');
        $this->addSql('ALTER TABLE produit ADD sous_categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27365BF48 ON produit (sous_categorie_id)');
        $this->addSql('ALTER TABLE sous_categorie ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_52743D7BBCF5E72D ON sous_categorie (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE panier_achat DROP FOREIGN KEY FK_F84ABEB19EB6921');
        $this->addSql('ALTER TABLE payement DROP FOREIGN KEY FK_B20A788519EB6921');
        $this->addSql('DROP TABLE client');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D868C0609');
        $this->addSql('DROP INDEX IDX_6EEAA67D19EB6921 ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D868C0609 ON commande');
        $this->addSql('ALTER TABLE commande DROP client_id, DROP payement_id');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76F347EFB');
        $this->addSql('DROP INDEX IDX_D8698A76F347EFB ON document');
        $this->addSql('ALTER TABLE document DROP produit_id');
        $this->addSql('ALTER TABLE panier_achat DROP FOREIGN KEY FK_F84ABEB82EA2E54');
        $this->addSql('DROP INDEX IDX_F84ABEB19EB6921 ON panier_achat');
        $this->addSql('DROP INDEX UNIQ_F84ABEB82EA2E54 ON panier_achat');
        $this->addSql('ALTER TABLE panier_achat DROP client_id, DROP commande_id');
        $this->addSql('DROP INDEX IDX_B20A788519EB6921 ON payement');
        $this->addSql('ALTER TABLE payement DROP client_id');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27365BF48');
        $this->addSql('DROP INDEX IDX_29A5EC27365BF48 ON produit');
        $this->addSql('ALTER TABLE produit DROP sous_categorie_id');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BBCF5E72D');
        $this->addSql('DROP INDEX IDX_52743D7BBCF5E72D ON sous_categorie');
        $this->addSql('ALTER TABLE sous_categorie DROP categorie_id');
    }
}
