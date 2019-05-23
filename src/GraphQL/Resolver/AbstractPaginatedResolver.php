<?php

namespace App\GraphQL\Resolver
{
    use Doctrine\ORM\QueryBuilder;
    use Doctrine\ORM\Tools\Pagination\Paginator;
    use Overblog\GraphQLBundle\Definition\Argument;

    abstract class AbstractPaginatedResolver
        extends AbstractInvokeResolver
    {
        abstract protected function updateQueryWithArgumentsInternal(QueryBuilder $qb, Argument $args);

        protected function doResolveInternal(Argument $args)
        {
            $qb = $this->repo()->createQueryBuilder('_e');
            $qb->setFirstResult(0);
            $qb->setMaxResults(25);

            if ($args->offsetExists('offset'))
            {
                $qb->setFirstResult($args['offset']);
            }
            if ($args->offsetExists('limit'))
            {
                $qb->setMaxResults($args['limit']);
            }
            if ($args->offsetExists('orderBy'))
            {
                $this->updateQueryWithOrderByInternal($qb, $args['orderBy']);
            }

            $this->updateQueryWithArgumentsInternal($qb, $args);

            return new Paginator($qb, false);
        }

        protected function updateQueryWithOrderByInternal(QueryBuilder $qb, array $sorting)
        {
            array_walk($sorting, function($si) use ($qb) {
                $qb->orderBy("_e.{$si['field']}", $si['direction']);
            });
        }

        public function resolveOffset(Paginator $paginator)
        {
            return $paginator->getQuery()->getFirstResult();
        }

        public function resolveLimit(Paginator $paginator)
        {
            return $paginator->getQuery()->getMaxResults();
        }

        public function resolveFilteredCount(Paginator $paginator)
        {
            return $paginator->count();
        }

        public function resolveItems(Paginator $paginator)
        {
            return $paginator->getQuery()->execute();
        }
    }
}