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
final class TitleType extends ObjectType implements GeneratedTypeInterface
{

    public function __construct(ConfigProcessor $configProcessor, GlobalVariables $globalVariables = null)
    {
        $configLoader = function(GlobalVariables $globalVariable) {
            return [
            'name' => 'Title',
            'description' => 'IMDb Title representation.',
            'fields' => function () use ($globalVariable) {
                return [
                'id' => [
                    'type' => Type::nonNull(Type::id()),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Identifier.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'type' => [
                    'type' => Type::nonNull(Type::string()),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Type or format.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'primaryTitle' => [
                    'type' => Type::nonNull(Type::string()),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Primary title used for promotional purposes.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'originalTitle' => [
                    'type' => Type::nonNull(Type::string()),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Original title in original language.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'isAdult' => [
                    'type' => Type::nonNull(Type::boolean()),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Indicating adult title.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'releaseYear' => [
                    'type' => Type::int(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Release year.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'runtimeMinutes' => [
                    'type' => Type::int(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Runtime in minutes.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'rating' => [
                    'type' => Type::float(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Rating given by IMDb users.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'inWatchlist' => [
                    'type' => Type::boolean(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Indicates, whether this field is in current users\' watchlist.',
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
                'numVotes' => [
                    'type' => Type::int(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Number of votes.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'imdbUrl' => [
                    'type' => Type::string(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'URL of the title entry on IMDb.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'names' => [
                    'type' => Type::listOf($globalVariable->get('typeResolver')->resolve('TitleName')),
                    'args' => [
                        [
                            'name' => 'category',
                            'type' => Type::string(),
                            'description' => 'Categories to query (delimited by comma)',
                        ],
                    ],
                    'resolve' => null,
                    'description' => 'Associated names (directors, producers, writers, actors,...).',
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
            'resolveField' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\TitleResolver", [0 => $info, 1 => $value, 2 => $args]]);
            },
        ];
        };
        $config = $configProcessor->process(LazyConfig::create($configLoader, $globalVariables))->load();
        parent::__construct($config);
    }
}
