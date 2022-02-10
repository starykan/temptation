<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220205194537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
      $this->addSql('CREATE TABLE shops(
								    	id INT NOT NULL AUTO_INCREMENT,
    									tel VARCHAR(255) NOT NULL,
    									adress VARCHAR(255)NOT NULL,
    									name VARCHAR(255) NOT NULL,
										info VARCHAR(255) NOT  NULL,
										mainPic VARCHAR(255) NOT  NULL,
    									PRIMARY KEY(id)
    									) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
