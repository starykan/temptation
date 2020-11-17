<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201117154247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE products ADD COLUMN main_image_hash VARCHAR(255), 
            ADD CONSTRAINT products_main_image_hash FOREIGN KEY (main_image_hash) REFERENCES product_images(image_hash)');
    }

    public function down(Schema $schema) : void
    {

    }
}
