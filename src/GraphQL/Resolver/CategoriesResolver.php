<?php

namespace App\GraphQL\Resolver
{
    use Doctrine\ORM\EntityManagerInterface;
    use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

    class CategoriesResolver
        implements ResolverInterface
    {
        public function __construct(EntityManagerInterface $em)
        {
            $this->em = $em;
        }

        public function resolve()
        {
            $query = $this->em->createQuery('select distinct tn.category from App:TitleName tn order by tn.category asc');

            return array_column($query->getScalarResult(), 'category');
        }

        //region --- Private members ---

        /** @var EntityManagerInterface */
        private $em;

        //endregion
    }
}