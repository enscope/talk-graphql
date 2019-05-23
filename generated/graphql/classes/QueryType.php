<?php
namespace App\GraphQL\Generated;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Overblog\GraphQLBundle\Definition\ConfigProcessor;
use Overblog\GraphQLBundle\Definition\GlobalVariables;
use Overblog\GraphQLBundle\Definition\LazyConfig;
use Overblog\GraphQLBundle\Definition\Type\GeneratedTypeInterface;

/**
 * THIS FILE WAS GENERATED AND SHOULD NOT BE MODIFIED!
 */
final class QueryType extends ObjectType implements GeneratedTypeInterface
{

    public function __construct(ConfigProcessor $configProcessor, GlobalVariables $globalVariables = null)
    {
        $configLoader = function(GlobalVariables $globalVariable) {
            return [
            'name' => 'Query',
            'description' => 'Base query.',
            'fields' => function () use ($globalVariable) {
                return [
                'title' => [
                    'type' => $globalVariable->get('typeResolver')->resolve('Title'),
                    'args' => [
                        [
                            'name' => 'id',
                            'type' => Type::id(),
                            'description' => 'Identifier of the title.',
                        ],
                    ],
                    'resolve' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                        return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\TitleResolver::resolve", [0 => $args]]);
                    },
                    'description' => 'Query single title entry by identifier.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'titles' => [
                    'type' => $globalVariable->get('typeResolver')->resolve('PaginatedTitles'),
                    'args' => [
                        [
                            'name' => 'type',
                            'type' => Type::string(),
                            'description' => 'Type of the title.',
                        ],
                        [
                            'name' => 'primaryTitle',
                            'type' => Type::string(),
                            'description' => 'Primary title of the title.',
                        ],
                        [
                            'name' => 'originalTitle',
                            'type' => Type::string(),
                            'description' => 'Original title of the title.',
                        ],
                        [
                            'name' => 'offset',
                            'type' => Type::int(),
                            'description' => 'First item.',
                        ],
                        [
                            'name' => 'limit',
                            'type' => Type::int(),
                            'description' => 'Maximum number of items.',
                        ],
                        [
                            'name' => 'orderBy',
                            'type' => Type::listOf($globalVariable->get('typeResolver')->resolve('OrderByInput')),
                            'description' => 'Ordering specification.',
                        ],
                    ],
                    'resolve' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                        return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\PaginatedTitlesResolver::resolve", [0 => $args]]);
                    },
                    'description' => 'Query multiple title entries by specified filters.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'name' => [
                    'type' => $globalVariable->get('typeResolver')->resolve('Name'),
                    'args' => [
                        [
                            'name' => 'id',
                            'type' => Type::id(),
                            'description' => 'Identifier of the name.',
                        ],
                    ],
                    'resolve' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                        return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\NameResolver::resolve", [0 => $args]]);
                    },
                    'description' => 'Query single name entry by identifier.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'names' => [
                    'type' => $globalVariable->get('typeResolver')->resolve('PaginatedNames'),
                    'args' => [
                        [
                            'name' => 'primaryName',
                            'type' => Type::string(),
                            'description' => 'Primary name of a person.',
                        ],
                        [
                            'name' => 'offset',
                            'type' => Type::int(),
                            'description' => 'First item.',
                        ],
                        [
                            'name' => 'limit',
                            'type' => Type::int(),
                            'description' => 'Maximum number of items.',
                        ],
                        [
                            'name' => 'orderBy',
                            'type' => Type::listOf($globalVariable->get('typeResolver')->resolve('OrderByInput')),
                            'description' => 'Ordering specification.',
                        ],
                    ],
                    'resolve' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                        return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\PaginatedNamesResolver::resolve", [0 => $args]]);
                    },
                    'description' => 'Query multiple name entries by specified filters.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'watchlist' => [
                    'type' => $globalVariable->get('typeResolver')->resolve('PaginatedWatchlist'),
                    'args' => [
                        [
                            'name' => 'offset',
                            'type' => Type::int(),
                            'description' => 'First item.',
                        ],
                        [
                            'name' => 'limit',
                            'type' => Type::int(),
                            'description' => 'Maximum number of items.',
                        ],
                    ],
                    'resolve' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                        return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\PaginatedWatchlistResolver::resolve", [0 => $args]]);
                    },
                    'description' => 'Query paginated watchlist of current user.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => function ($fieldName) use ($globalVariable)  {
                        $publicCallback = function ($typeName, $fieldName) use ($globalVariable) {
                        return ($globalVariable->get('container')->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') || $globalVariable->get('container')->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'));
                    };
                        return call_user_func($publicCallback, $this->name, $fieldName);
                    },
                    'access' => function ($value, $args, $context, ResolveInfo $info, $object) use ($globalVariable) {
                        return ($globalVariable->get('container')->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') || $globalVariable->get('container')->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'));
                    },
                    'useStrictAccess' => true,
                ],
                'categories' => [
                    'type' => Type::listOf(Type::string()),
                    'args' => [
                    ],
                    'resolve' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                        return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\CategoriesResolver::resolve", []]);
                    },
                    'description' => 'Provides list of Title to Name relation categories.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'greeter' => [
                    'type' => $globalVariable->get('typeResolver')->resolve('Greeter'),
                    'args' => [
                    ],
                    'resolve' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                        return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\GreeterResolver::resolve", []]);
                    },
                    'description' => 'Example of Greeter custom type.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
            ];
            },
            'interfaces' => function () use ($globalVariable) {
                return [];
            },
            'isTypeOf' => null,
            'resolveField' => null,
        ];
        };
        $config = $configProcessor->process(LazyConfig::create($configLoader, $globalVariables))->load();
        parent::__construct($config);
    }
}
