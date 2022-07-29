<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220729231146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quote_has_user');
        $this->addSql('ALTER TABLE author CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE last-name last_name VARCHAR(100) NOT NULL, CHANGE first-name first_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(100) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY fk_quote_author');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY fk_quote_category1');
        $this->addSql('DROP INDEX fk_quote_author_idx ON quote');
        $this->addSql('DROP INDEX fk_quote_category1_idx ON quote');
        $this->addSql('ALTER TABLE quote ADD author_id_id INT NOT NULL, ADD category_id_id INT NOT NULL, DROP author_id, DROP category_id, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF469CCBE9A FOREIGN KEY (author_id_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF49777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_6B71CBF469CCBE9A ON quote (author_id_id)');
        $this->addSql('CREATE INDEX IDX_6B71CBF49777D11E ON quote (category_id_id)');
        $this->addSql('ALTER TABLE report DROP created_at, DROP updated_at, CHANGE reason reason JSON NOT NULL');
        $this->addSql('ALTER TABLE report RENAME INDEX fk_report_quote1_idx TO IDX_C42F7784DB805178');
        $this->addSql('ALTER TABLE report RENAME INDEX fk_report_user1_idx TO IDX_C42F7784A76ED395');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(100) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE role role JSON NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quote_has_user (quote_id INT NOT NULL, user_id INT NOT NULL, INDEX fk_quote_has_user_quote1_idx (quote_id), INDEX fk_quote_has_user_user1_idx (user_id), PRIMARY KEY(quote_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE quote_has_user ADD CONSTRAINT fk_quote_has_user_quote1 FOREIGN KEY (quote_id) REFERENCES quote (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE quote_has_user ADD CONSTRAINT fk_quote_has_user_user1 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE author ADD last-name VARCHAR(100) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, ADD first-name VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, DROP last_name, DROP first_name, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(45) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF469CCBE9A');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF49777D11E');
        $this->addSql('DROP INDEX IDX_6B71CBF469CCBE9A ON quote');
        $this->addSql('DROP INDEX IDX_6B71CBF49777D11E ON quote');
        $this->addSql('ALTER TABLE quote ADD author_id INT NOT NULL, ADD category_id INT NOT NULL, DROP author_id_id, DROP category_id_id, CHANGE text text LONGTEXT NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT fk_quote_author FOREIGN KEY (author_id) REFERENCES author (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT fk_quote_category1 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX fk_quote_author_idx ON quote (author_id)');
        $this->addSql('CREATE INDEX fk_quote_category1_idx ON quote (category_id)');
        $this->addSql('ALTER TABLE report ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP, ADD updated_at DATETIME DEFAULT NULL, CHANGE reason reason VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE report RENAME INDEX idx_c42f7784db805178 TO fk_report_quote1_idx');
        $this->addSql('ALTER TABLE report RENAME INDEX idx_c42f7784a76ed395 TO fk_report_user1_idx');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(45) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE password password VARCHAR(100) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE role role VARCHAR(255) NOT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }
}
