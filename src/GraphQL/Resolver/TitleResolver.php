<?php

namespace App\GraphQL\Resolver
{
    use App\Entity\Name;
    use App\Entity\Title;
    use App\Entity\TitleName;
    use App\Entity\WatchlistEntry;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\Query\Expr\Join;
    use GraphQL\Error\UserError;
    use Overblog\GraphQLBundle\Definition\Argument;
    use Symfony\Component\Security\Core\Security;

    class TitleResolver
        extends AbstractInvokeResolver
    {
        public function __construct(EntityManagerInterface $em, Security $security)
        {
            $this->security = $security;

            parent::__construct($em, Title::class);
        }

        protected function doResolveInternal(Argument $args)
        {
            if ($args->offsetExists('id'))
            {
                return $this->repo()->find($args['id']);
            }

            throw new UserError('Invalid query.');
        }

        public function resolveIsAdult(Title $title): bool
        {
            return $title->isAdult();
        }

        public function resolveImdbUrl(Title $title): string
        {
            return "https://www.imdb.com/title/{$title->getId()}/";
        }

        public function resolveInWatchlist(Title $title): int
        {
            $currentUser = $this->security->getUser();
            if ($currentUser === null)
            {
                throw new UserError('Authorization required to perform this action.');
            }

            $repo = $this->em()->getRepository(WatchlistEntry::class);
            $criteria = ['username' => $currentUser->getUsername(),
                         'title'    => $title];

            return ($repo->findOneBy($criteria) !== null);
        }

        public function resolveNames(Title $title, Argument $args): array
        {
            /** @var EntityRepository $repo */
            $repo = $this->em()->getRepository(TitleName::class);

            $qb = $repo->createQueryBuilder('_tn')
                       ->leftJoin(Name::class, "_n", Join::WITH, '_n = _tn.name');

            $qb->andWhere($qb->expr()->eq('_tn.title', ':title'))
               ->setParameter('title', $title);

            if ($args->offsetExists('category'))
            {
                $categoryArray = explode(',', $args['category']);
                $qb->andWhere($qb->expr()->in('_tn.category', $categoryArray));
            }

            $qb->orderBy('_tn.ordering', 'ASC');

            return $qb->getQuery()->getResult();
        }

        //region --- Private members ---

        private $security;

        //endregion
    }
}