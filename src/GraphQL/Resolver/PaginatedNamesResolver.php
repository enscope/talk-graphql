<?php

namespace App\GraphQL\Resolver
{
    use App\Entity\Name;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\ORM\QueryBuilder;
    use Overblog\GraphQLBundle\Definition\Argument;

    class PaginatedNamesResolver
        extends AbstractPaginatedResolver
    {
        public function __construct(EntityManagerInterface $em)
        {
            parent::__construct($em, Name::class);
        }

        protected function updateQueryWithArgumentsInternal(QueryBuilder $qb, Argument $args)
        {
            if ($args->offsetExists('primaryName'))
            {
                $qb->andWhere($qb->expr()->eq('_e.primaryName', ':primaryName'))
                   ->setParameter('primaryName', $args['primaryName']);
            }
            if ($args->offsetExists('birthYear'))
            {
                $qb->andWhere($qb->expr()->eq('_e.birthYear', ':birthYear'))
                   ->setParameter('birthYear', $args['birthYear']);
            }
            if ($args->offsetExists('deathYear'))
            {
                $qb->andWhere($qb->expr()->eq('_e.deathYear', ':deathYear'))
                   ->setParameter('deathYear', $args['deathYear']);
            }
        }
    }
}