<?php

namespace App\Repository;

use App\Entity\ProductImage;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getFindAllQuery(): Query
    {
        return $this
            ->createQueryBuilder('product')
            ->getQuery();
    }

    /**
     * @return Product[]
     */
    public function findByCategory(Category $category): array
    //1 entity Category c одним аргументом, проверка что возвращает массив
    {
        return $this
            ->createQueryBuilder('product')
            //обозначаем условно энтити для которой пишем запрос
            ->andWhere('product.category = :category')
            //условие выборки. делаем выборку продуктов по категории, параметр запроса
            ->setParameter('category', $category)
            //параметр выборки
            ->getQuery()
            //получаем обьект запроса
            ->getResult();
            //получаем результат запроса (выборку)
    }

    public function findById(int $id): ?Product
    {
        return $this
            ->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    public function  findPics(ProductImage $productImage, int $id ): ?ProductImage
    {
    	return $this
    	->createQueryBuilder('productImage')
    	->andWhere('productImage.id = :id')
    	->setParameter('id', $id)
    	->getQuery()
    	->getResult();
    }
    
    
    
}