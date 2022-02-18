<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220218143159 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function isTransactional() : bool
    {
    	return false;
    }
    
    public function up(Schema $schema) : void
    {
    	$this->addSql('CREATE TABLE shops(
								    	id INT NOT NULL AUTO_INCREMENT,
    									tel VARCHAR(255) NOT NULL,
    									adress VARCHAR(255)NOT NULL,
    									name VARCHAR(255) NOT NULL,
										info VARCHAR(255) NOT  NULL,
										main_image_hash VARCHAR(255),
    									PRIMARY KEY(id)
    									) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
    			);
    	
    	$this->addSql('CREATE TABLE shop_images (
	       						         shop_id INT NOT NULL,
	       						         image_hash VARCHAR(255),
	        						     PRIMARY KEY(image_hash),
	       						         CONSTRAINT shop_images_shop_id FOREIGN KEY (shop_id) REFERENCES shops(id) ON DELETE CASCADE ON UPDATE CASCADE
	        						    ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
    			);
    	
    	$this->addSql('ALTER TABLE shops 
										ADD CONSTRAINT shops_main_image_hash FOREIGN KEY (main_image_hash) REFERENCES shop_images(image_hash) ON DELETE CASCADE ON UPDATE CASCADE'
    			);
    }

    public function down(Schema $schema) : void
    {
    	
    }
}
