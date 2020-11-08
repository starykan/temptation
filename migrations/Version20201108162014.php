<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201108162014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE products (
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                category_id INT NOT NULL,
                price INT NOT NULL,
                full_price INT,
                content VARCHAR(512),
                PRIMARY KEY(id),
                CONSTRAINT products_category_id FOREIGN KEY (category_id) REFERENCES categories (id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE products');
    }
}
