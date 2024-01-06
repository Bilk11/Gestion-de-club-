<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104221648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612E7A1254A');
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE educateur ADD licencie_id INT DEFAULT NULL, ADD is_admin TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE educateur ADD CONSTRAINT FK_763C0122B56DCD74 FOREIGN KEY (licencie_id) REFERENCES licencie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_763C0122B56DCD74 ON educateur (licencie_id)');
        $this->addSql('DROP INDEX UNIQ_3B755612E7A1254A ON licencie');
        $this->addSql('ALTER TABLE licencie DROP contact_id, DROP contact');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numerotel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE educateur DROP FOREIGN KEY FK_763C0122B56DCD74');
        $this->addSql('DROP INDEX UNIQ_763C0122B56DCD74 ON educateur');
        $this->addSql('ALTER TABLE educateur DROP licencie_id, DROP is_admin');
        $this->addSql('ALTER TABLE licencie ADD contact_id INT DEFAULT NULL, ADD contact LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\'');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B755612E7A1254A ON licencie (contact_id)');
    }
}
