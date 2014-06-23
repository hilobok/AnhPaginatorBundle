<?php

namespace Anh\PaginatorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AnhPaginatorExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($config['enable_short_alias']) {
            $container->setAlias('paginator', 'anh_paginator.paginator');
        }

        $container->setParameter('anh_paginator.page_number_route_parameter', $config['page_number_route_parameter']);
        $container->setParameter('anh_paginator.default_view', $config['view']['default']);

        $container->setParameter('anh_paginator.view_config', $config['view']);
    }
}
