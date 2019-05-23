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
final class GreeterType extends ObjectType implements GeneratedTypeInterface
{

    public function __construct(ConfigProcessor $configProcessor, GlobalVariables $globalVariables = null)
    {
        $configLoader = function(GlobalVariables $globalVariable) {
            return [
            'name' => 'Greeter',
            'description' => 'Example greeter type.',
            'fields' => function () use ($globalVariable) {
                return [
                'helloWorld' => [
                    'type' => Type::nonNull(Type::string()),
                    'args' => [
                    ],
                    'resolve' => null,
                    'description' => 'Says \'Hello, World!\'',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'goodMorning' => [
                    'type' => Type::nonNull(Type::string()),
                    'args' => [
                        [
                            'name' => 'name',
                            'type' => Type::string(),
                            'description' => 'Your name.',
                        ],
                    ],
                    'resolve' => null,
                    'description' => 'Says \'good morning\'.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'goodEvening' => [
                    'type' => Type::nonNull(Type::string()),
                    'args' => [
                        [
                            'name' => 'name',
                            'type' => Type::string(),
                            'description' => 'Your name.',
                        ],
                    ],
                    'resolve' => null,
                    'description' => 'Says \'good evening\'.',
                    'deprecationReason' => null,
                    'complexity' => null,
                    # public and access are custom options managed only by the bundle
                    'public' => null,
                    'access' => null,
                    'useStrictAccess' => true,
                ],
                'happyBirthday' => [
                    'type' => Type::nonNull(Type::string()),
                    'args' => [
                        [
                            'name' => 'name',
                            'type' => Type::string(),
                            'description' => 'Your name.',
                        ],
                    ],
                    'resolve' => null,
                    'description' => 'Says \'happy birthday\'.',
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
                return $globalVariable->get('resolverResolver')->resolve(["App\\GraphQL\\Resolver\\GreeterResolver", [0 => $info, 1 => $value, 2 => $args]]);
            },
        ];
        };
        $config = $configProcessor->process(LazyConfig::create($configLoader, $globalVariables))->load();
        parent::__construct($config);
    }
}
