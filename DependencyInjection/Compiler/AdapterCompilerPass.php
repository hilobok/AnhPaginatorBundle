<?php

namespace Anh\PaginatorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class AdapterCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('anh_paginator.adapter_resolver')) {
            return;
        }

        $definition = $container->getDefinition(
            'anh_paginator.adapter_resolver'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'anh_paginator.adapter'
        );

        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addAdapter',
                array(new Reference($id))
            );
        }
    }
}
