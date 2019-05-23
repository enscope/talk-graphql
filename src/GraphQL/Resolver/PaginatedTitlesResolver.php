<?php

namespace App\GraphQL\Resolver
{
    use App\Entity\Title;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\ORM\QueryBuilder;
    use Overblog\GraphQLBundle\Definition\Argument;

    class PaginatedTitlesResolver
        extends AbstractPaginatedResolver
    {
        public function __construct(EntityManagerInterface $em)
        {
            parent::__construct($em, Title::class);
        }

        protected function updateQueryWithArgumentsInternal(QueryBuilder $qb, Argument $args)
        {
            if ($args->offsetExists('type'))
            {
                $qb->andWhere($qb->expr()->eq('_e.type', ':type'))
                   ->setParameter('type', $args['type']);
            }
            if ($args->offsetExists('primaryTitle'))
            {
                $qb->andWhere($qb->expr()->eq('_e.primaryTitle', ':primaryTitle'))
                   ->setParameter('primaryTitle', $args['primaryTitle']);
            }
            if ($args->offsetExists('originalTitle'))
            {
                $qb->andWhere($qb->expr()->eq('_e.originalTitle', ':originalTitle'))
                   ->setParameter('originalTitle', $args['originalTitle']);
            }
        }
    }
}