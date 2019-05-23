<?php

namespace App\GraphQL\Resolver
{
    use App\Entity\Title;
    use App\Entity\WatchlistEntry;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\ORM\Query\Expr\Join;
    use Doctrine\ORM\QueryBuilder;
    use Doctrine\ORM\Tools\Pagination\Paginator;
    use GraphQL\Error\UserError;
    use Overblog\GraphQLBundle\Definition\Argument;
    use Symfony\Component\Security\Core\Security;

    class PaginatedWatchlistResolver
        extends AbstractPaginatedResolver
    {
        public function __construct(EntityManagerInterface $em, Security $security)
        {
            $this->security = $security;

            parent::__construct($em, WatchlistEntry::class);
        }

        protected function updateQueryWithArgumentsInternal(QueryBuilder $qb, Argument $args)
        {
            $currentUser = $this->security->getUser();
            if ($currentUser === null)
            {
                throw new UserError('Authorization required to perform this action.');
            }

            // retrieve only title information
            $qb->select('_t')
               ->andWhere($qb->expr()->eq('_e.username', ':username'))
               ->setParameter('username', $currentUser->getUsername())
               ->leftJoin(Title::class, '_t', Join::WITH, '_t = _e.title');
        }

        public function resolveItems(Paginator $paginator)
        {
            // disable output walkers, as it causes an error while fetching
            $paginator->setUseOutputWalkers(false);

            /** @var Title[] $entries */
            return $paginator->getQuery()->getResult();
        }

        //region --- Private members ---

        private $security;

        //endregion
    }
}