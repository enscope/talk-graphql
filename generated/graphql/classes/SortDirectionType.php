<?php
namespace App\GraphQL\Generated;

use GraphQL\Type\Definition\EnumType;
use Overblog\GraphQLBundle\Definition\ConfigProcessor;
use Overblog\GraphQLBundle\Definition\GlobalVariables;
use Overblog\GraphQLBundle\Definition\LazyConfig;
use Overblog\GraphQLBundle\Definition\Type\GeneratedTypeInterface;

/**
 * THIS FILE WAS GENERATED AND SHOULD NOT BE MODIFIED!
 */
final class SortDirectionType extends EnumType implements GeneratedTypeInterface
{

    public function __construct(ConfigProcessor $configProcessor, GlobalVariables $globalVariables = null)
    {
        $configLoader = function(GlobalVariables $globalVariable) {
            return [
            'name' => 'SortDirection',
            'values' => [
                'ASC' => [
                    'name' => 'ASC',
                    'value' => 'asc',
                    'deprecationReason' => null,
                    'description' => 'Ascending sort order.',
                ],
                'DESC' => [
                    'name' => 'DESC',
                    'value' => 'desc',
                    'deprecationReason' => null,
                    'description' => 'Descending sort order.',
                ],
            ],
            'description' => 'Sort direction',
        ];
        };
        $config = $configProcessor->process(LazyConfig::create($configLoader, $globalVariables))->load();
        parent::__construct($config);
    }
}
