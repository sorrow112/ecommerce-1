<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210714122258 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C35F0816A76ED395 ON adresse (user_id)');
        $this->addSql('ALTER TABLE commande ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('ALTER TABLE panier_achat ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier_achat ADD CONSTRAINT FK_F84ABEBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F84ABEBA76ED395 ON panier_achat (user_id)');
        $this->addSql('ALTER TABLE payement ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payement ADD CONSTRAINT FK_B20A7885A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B20A7885A76ED395 ON payement (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('DROP INDEX IDX_C35F0816A76ED395 ON adresse');
        $this->addSql('ALTER TABLE adresse DROP user_id');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('DROP INDEX IDX_6EEAA67DA76ED395 ON commande');
        $this->addSql('ALTER TABLE commande DROP user_id');
        $this->addSql('ALTER TABLE panier_achat DROP FOREIGN KEY FK_F84ABEBA76ED395');
        $this->addSql('DROP INDEX IDX_F84ABEBA76ED395 ON panier_achat');
        $this->addSql('ALTER TABLE panier_achat DROP user_id');
        $this->addSql('ALTER TABLE payement DROP FOREIGN KEY FK_B20A7885A76ED395');
        $this->addSql('DROP INDEX IDX_B20A7885A76ED395 ON payement');
        $this->addSql('ALTER TABLE payement DROP user_id');
    }
}
