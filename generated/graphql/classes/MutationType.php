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
final class MutationType extends ObjectType implements GeneratedTypeInterface
{

    public function __construct(ConfigProcessor $configProcessor, GlobalVariables $globalVariables = null)
    {
        $configLoader = function(GlobalVariables $globalVariable) {
            return [
            'name' => 'Mutation',
            'description' => 'Base mutation.',
            'fields' => function () use ($globalVariable) {
                return [
                'AddToWatchlist' => [
                    'type' => $globalVariable->get('typeResolver')->resolve('Title'),
                    'args' => [
                        [
                            'name' => 'id',
                            'type' => Type::nonNull(Type::id()),
                            'description' => 'Identifier of the title to add.',
                        ],
                    ],
                    'resolve' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                        return $globalVariable->get('mutationResolver')->resolve(["App\\GraphQL\\Mutation\\WatchlistMutation::addToWatchlist", [0 => $args["id"]]]);
                    },
                    'description' => 'Adds a title to current users\' watchlist.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => function ($value, $args, $context, ResolveInfo $info, $object) use ($globalVariable) {
                        return ($globalVariable->get('container')->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') || $globalVariable->get('container')->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'));
                    },
                    'useStrictAccess' => true,
                ],
                'RemoveFromWatchlist' => [
                    'type' => $globalVariable->get('typeResolver')->resolve('Title'),
                    'args' => [
                        [
                            'name' => 'id',
                            'type' => Type::nonNull(Type::id()),
                            'description' => 'Identifier of the title to remove.',
                        ],
                    ],
                    'resolve' => function ($value, $args, $context, ResolveInfo $info) use ($globalVariable) {
                        return $globalVariable->get('mutationResolver')->resolve(["App\\GraphQL\\Mutation\\WatchlistMutation::removeFromWatchlist", [0 => $args["id"]]]);
                    },
                    'description' => 'Removes a title from current users\' watchlist.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => function ($value, $args, $context, ResolveInfo $info, $object) use ($globalVariable) {
                        return ($globalVariable->get('container')->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') || $globalVariable->get('container')->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'));
                    },
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
