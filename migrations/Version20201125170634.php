<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201125170634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE products DROP CONSTRAINT products_category_id');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT products_category_id FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->addSql('ALTER TABLE products DROP CONSTRAINT products_main_image_hash');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT `products_main_image_hash` FOREIGN KEY (`main_image_hash`) REFERENCES `product_images` (`image_hash`) ON DELETE CASCADE ON UPDATE CASCADE');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE categories CHANGE gender gender TINYINT(1) NOT NULL');
//        $this->addSql('ALTER TABLE product_images DROP FOREIGN KEY FK_8263FFCE4584665A');
//        $this->addSql('ALTER TABLE product_images CHANGE product_id product_id INT NOT NULL');
//        $this->addSql('ALTER TABLE product_images ADD CONSTRAINT product_images_product_id FOREIGN KEY (product_id) REFERENCES products (id) ON UPDATE CASCADE ON DELETE CASCADE');
//        $this->addSql('ALTER TABLE product_images RENAME INDEX idx_8263ffce4584665a TO product_images_product_id');
//        $this->addSql('ALTER TABLE products CHANGE category_id category_id INT NOT NULL, CHANGE full_price full_price INT DEFAULT NULL, CHANGE content content VARCHAR(512) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
//        $this->addSql('ALTER TABLE products RENAME INDEX idx_b3ba5a5a12469de2 TO products_category_id');
//        $this->addSql('ALTER TABLE products RENAME INDEX idx_b3ba5a5a1b7afc45 TO products_main_image_hash');
    }
}
