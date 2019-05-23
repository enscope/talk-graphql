<?php

namespace App\GraphQL\Resolver
{
    use App\Entity\Name;
    use App\Entity\Title;
    use App\Entity\TitleName;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\Query\Expr\Join;
    use GraphQL\Error\UserError;
    use Overblog\GraphQLBundle\Definition\Argument;

    class NameResolver
        extends AbstractInvokeResolver
    {
        public function __construct(EntityManagerInterface $em)
        {
            parent::__construct($em, Name::class);
        }

        protected function doResolveInternal(Argument $args)
        {
            if ($args->offsetExists('id'))
            {
                return $this->repo()->find($args['id']);
            }

            throw new UserError('Invalid query.');
        }

        public function resolveImdbUrl(Name $name)
        {
            return "https://www.imdb.com/name/{$name->getId()}/";
        }

        public function resolveTitles(Name $name, Argument $args)
        {
            /** @var EntityRepository $repo */
            $repo = $this->em()->getRepository(TitleName::class);

            $qb = $repo->createQueryBuilder('_tn')
                       ->leftJoin(Title::class, "_t", Join::WITH, '_t = _tn.title');

            $qb->andWhere($qb->expr()->eq('_tn.name', ':name'))
               ->setParameter('name', $name);

            if ($args->offsetExists('category'))
            {
                $categoryArray = explode(',', $args['category']);
                $qb->andWhere($qb->expr()->in('_tn.category', $categoryArray));
            }
            if ($args->offsetExists('type'))
            {
                $typeArray = explode(',', $args['type']);
                $qb->andWhere($qb->expr()->in('_t.type', $typeArray));
            }

            $qb->orderBy('_t.releaseYear', 'DESC');

            return $qb->getQuery()->getResult();
        }
    }
}