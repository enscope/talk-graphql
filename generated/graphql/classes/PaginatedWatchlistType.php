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
final class PaginatedWatchlistType extends ObjectType implements GeneratedTypeInterface
{

    public function __construct(ConfigProcessor $configProcessor, GlobalVariables $globalVariables = null)
    {
        $configLoader = function(GlobalVariables $globalVariable) {
            return [
            'name' => 'PaginatedWatchlist',
            'description' => 'Paginated watchlist representation.',
            'fields' => function () use ($globalVariable) {
                return [
                'offset' => [
                    'type' => Type::int(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Offset of the first item.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'limit' => [
                    'type' => Type::int(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Maximum number of returned items.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'filteredCount' => [
                    'type' => Type::int(),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Total count of items matching filter.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'items' => [
                    'type' => Type::listOf($globalVariable->get('typeResolver')->resolve('Title')),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Titles in my watchlist.',
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
                return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\PaginatedWatchlistResolver", [0 => $info, 1 => $value, 2 => $args]]);
            },
        ];
        };
        $config = $configProcessor->process(LazyConfig::create($configLoader, $globalVariables))->load();
        parent::__construct($config);
    }
}
