<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function nextArticle($date): array
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')
            ->where('p.date > :date')
            ->andWhere('p.published = :published')
            ->andWhere('p.type = :type')
            ->setParameter('date', $date)
            ->setParameter('published', 1)
            ->setParameter('type', 0)
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->orderBy("p.date", "ASC")
            ->getQuery();

        return $qb->execute();
    }

    public function prevArticle($date): array
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')
            ->where('p.date < :date')
            ->andWhere('p.published = :published')
            ->setParameter('date', $date)
            ->setParameter('published', 1)
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->orderBy("p.date", "DESC")
            ->getQuery();

        return $qb->execute();
    }

}
