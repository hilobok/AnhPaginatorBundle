<?php

namespace Anh\PaginatorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Anh\PaginatorBundle\DependencyInjection\Compiler\AdapterCompilerPass;
use Anh\PaginatorBundle\DependencyInjection\Compiler\ViewCompilerPass;

class AnhPaginatorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AdapterCompilerPass());
        $container->addCompilerPass(new ViewCompilerPass());
    }
}
