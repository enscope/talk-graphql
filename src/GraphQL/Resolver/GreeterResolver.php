<?php
namespace App\GraphQL\Resolver
{
    use GraphQL\Error\UserError;
    use GraphQL\Type\Definition\ResolveInfo;
    use Overblog\GraphQLBundle\Definition\Argument;
    use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

    class GreeterResolver
        implements ResolverInterface
    {
        public function __invoke(ResolveInfo $info, $value, Argument $args)
        {
            $resolverMethodName = 'resolve' . ucfirst($info->fieldName);
            if (method_exists($this, $resolverMethodName))
            {
                return $this->$resolverMethodName($value, $args);
            }

            throw new UserError("Field '$info->fieldName' does not exist.");
        }

        public function resolve()
        {
            return [];
        }

        public function resolveHelloWorld()
        {
            return 'Hello, World!';
        }

        public function resolveGoodMorning($value, Argument $args)
        {
            if ($args->offsetExists('name'))
            {
                return "Good Morning, {$args['name']}!";
            }

            return 'Good Morning!';
        }

        public function resolveGoodEvening($value, Argument $args)
        {
            if ($args->offsetExists('name'))
            {
                return "Good Evening, {$args['name']}!";
            }

            return 'Good Evening!';
        }

        public function resolveHappyBirthday($value, Argument $args)
        {
            if ($args->offsetExists('name'))
            {
                return "Happy Birthday, {$args['name']}!";
            }

            return 'Happy Birthday!';
        }
    }
}