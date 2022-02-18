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

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_products DROP FOREIGN KEY order_products_order_id');
        $this->addSql('CREATE TABLE shop_image (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, image_hash VARCHAR(255) NOT NULL, INDEX IDX_22B5E0D4D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shop_image ADD CONSTRAINT FK_22B5E0D4D16C4DD FOREIGN KEY (shop_id) REFERENCES shops (id)');
        $this->addSql('DROP TABLE order_products');
        $this->addSql('DROP TABLE orders');
        $this->addSql('ALTER TABLE product_images RENAME INDEX fk_8263ffce4584665a TO IDX_8263FFCE4584665A');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY products_category_id');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY products_main_image_hash');
        $this->addSql('ALTER TABLE products CHANGE category_id category_id INT DEFAULT NULL, CHANGE full_price full_price INT NOT NULL, CHANGE content content VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A1B7AFC45 FOREIGN KEY (main_image_hash) REFERENCES product_images (image_hash)');
        $this->addSql('ALTER TABLE products RENAME INDEX products_category_id TO IDX_B3BA5A5A12469DE2');
        $this->addSql('ALTER TABLE products RENAME INDEX products_main_image_hash TO IDX_B3BA5A5A1B7AFC45');
        $this->addSql('ALTER TABLE shops CHANGE main_pic main_pic VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_products (order_id INT NOT NULL, product_id INT NOT NULL, count INT NOT NULL, INDEX order_products_order_id (order_id), INDEX order_products_product_id (product_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, phone VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, comments VARCHAR(1000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE order_products ADD CONSTRAINT order_products_order_id FOREIGN KEY (order_id) REFERENCES orders (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_products ADD CONSTRAINT order_products_product_id FOREIGN KEY (product_id) REFERENCES products (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE shop_image');
        $this->addSql('ALTER TABLE product_images RENAME INDEX idx_8263ffce4584665a TO FK_8263FFCE4584665A');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A12469DE2');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A1B7AFC45');
        $this->addSql('ALTER TABLE products CHANGE category_id category_id INT NOT NULL, CHANGE full_price full_price INT DEFAULT NULL, CHANGE content content VARCHAR(512) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT products_category_id FOREIGN KEY (category_id) REFERENCES categories (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT products_main_image_hash FOREIGN KEY (main_image_hash) REFERENCES product_images (image_hash) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products RENAME INDEX idx_b3ba5a5a12469de2 TO products_category_id');
        $this->addSql('ALTER TABLE products RENAME INDEX idx_b3ba5a5a1b7afc45 TO products_main_image_hash');
        $this->addSql('ALTER TABLE shops CHANGE main_pic main_pic VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
