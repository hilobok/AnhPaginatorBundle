<?php

namespace Anh\PaginatorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class ViewCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('anh_paginator.view_resolver')) {
            return;
        }

        $definition = $container->getDefinition(
            'anh_paginator.view_resolver'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'anh_paginator.view'
        );

        $defaultViewAlias = $container->getParameter('anh_paginator.default_view');
        $config = $container->getParameter('anh_paginator.view_config');

        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall(
                    'addView',
                    array(new Reference($id), $attributes['alias'])
                );

                if ($defaultViewAlias == $attributes['alias']) {
                    $defaultView = $id;
                }
            }
        }

        if (isset($defaultView)) {
            $viewDefinition = $container->getDefinition($defaultView);

            if (!empty($config['templates'])) {
                $viewDefinition->addMethodCall('setTemplates', array($config['templates']));
            }

            if (!empty($config['options'])) {
                $viewDefinition->addMethodCall('setOptions', array($config['options']));
            }

            if (!empty($config['css'])) {
                $viewDefinition->addMethodCall('setCss', array($config['css']));
            }

            if (!empty($config['js'])) {
                $viewDefinition->addMethodCall('setJs', array($config['js']));
            }
        }
    }
}
