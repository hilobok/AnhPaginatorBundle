<?php

namespace Anh\PaginatorBundle\Assetic;

use Assetic\Factory\Loader\FormulaLoaderInterface;
use Assetic\Factory\Resource\ResourceInterface;

class AsseticLoader implements FormulaLoaderInterface
{
    public function load(ResourceInterface $resource)
    {
        return $resource instanceof AsseticResource ? $resource->getContent() : array();
    }
}
