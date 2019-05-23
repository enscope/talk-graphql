<?php
namespace App\GraphQL\Generated;

use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\Type;
use Overblog\GraphQLBundle\Definition\ConfigProcessor;
use Overblog\GraphQLBundle\Definition\GlobalVariables;
use Overblog\GraphQLBundle\Definition\LazyConfig;
use Overblog\GraphQLBundle\Definition\Type\GeneratedTypeInterface;

/**
 * THIS FILE WAS GENERATED AND SHOULD NOT BE MODIFIED!
 */
final class PaginatedInterfaceType extends InterfaceType implements GeneratedTypeInterface
{

    public function __construct(ConfigProcessor $configProcessor, GlobalVariables $globalVariables = null)
    {
        $configLoader = function(GlobalVariables $globalVariable) {
            return [
            'name' => 'PaginatedInterface',
            'description' => 'Base interface for all paginated types.',
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
            ];
            },
            'resolveType' => null,
        ];
        };
        $config = $configProcessor->process(LazyConfig::create($configLoader, $globalVariables))->load();
        parent::__construct($config);
    }
}
