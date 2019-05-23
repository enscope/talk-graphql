<?php

namespace App\GraphQL\Resolver
{
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\ORM\EntityRepository;
    use GraphQL\Error\UserError;
    use GraphQL\Type\Definition\ResolveInfo;
    use Overblog\GraphQLBundle\Definition\Argument;
    use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

    abstract class AbstractInvokeResolver
        implements ResolverInterface
    {
        public function __construct(EntityManagerInterface $em, $className = null)
        {
            $this->em = $em;
            $this->className = $className;
        }

        public function __invoke(ResolveInfo $info, $value, Argument $args)
        {
            $resolverMethodName = 'resolve' . ucfirst($info->fieldName);
            if (method_exists($this, $resolverMethodName))
            {
                return $this->$resolverMethodName($value, $args);
            }
            else
            {
                $getterMethodName = 'get' . ucfirst($info->fieldName);
                if (method_exists($value, $getterMethodName))
                {
                    return $value->$getterMethodName();
                }
            }

            throw new UserError("Field '$info->fieldName' does not exist.");
        }

        public function resolve(Argument $args)
        {
            $result = $this->doResolveInternal($args);
            if ($result === null)
            {
                throw new UserError('Not found.');
            }

            return $result;
        }

        abstract protected function doResolveInternal(Argument $args);

        protected function em(): EntityManagerInterface
        {
            return $this->em;
        }

        protected function repo($className = null): EntityRepository
        {
            /** @var EntityRepository $repo */
            $repo = $this->em->getRepository($this->className ?? $className);

            return $repo;
        }

        //region --- Private members ---

        /** @var EntityManagerInterface */
        private $em;

        /** @var null|string */
        private $className;

        //endregion
    }
}