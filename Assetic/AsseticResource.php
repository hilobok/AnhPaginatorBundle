<?php

namespace Anh\PaginatorBundle\Assetic;

use Assetic\Factory\Resource\ResourceInterface;
use Anh\PaginatorBundle\PaginatorViewResolver;

class AsseticResource implements ResourceInterface
{
    protected $viewResolver;

    protected $defaultView;

    public function __construct(PaginatorViewResolver $viewResolver, $defaultView)
    {
        $this->viewResolver = $viewResolver;
        $this->defaultView = $defaultView;
    }

    public function isFresh($timestamp)
    {
        return true;
    }

    public function getContent()
    {
        $formulae = array();

        $view = $this->viewResolver->resolve($this->defaultView);
        $formulae[$this->getName($this->defaultView, 'css', true)] = array(
            $view->getCss(),
            array(),
            array(),
        );

        $formulae[$this->getName($this->defaultView, 'js', true)] = array(
            $view->getJs(),
            array(),
            array(),
        );

        foreach ($this->viewResolver->getViews() as $alias => $view) {
            $css = $view->getCss();
            if ($css) {
                $formulae[$this->getName($alias, 'css', false)] = array(
                    $css,
                    array(),
                    array(),
                );
            }

            $js = $view->getJs();
            if ($js) {
                $formulae[$this->getName($alias, 'js', false)] = array(
                    $js,
                    array(),
                    array(),
                );
            }
        }

        return $formulae;
    }

    public function __toString()
    {
        return 'anh_paginator';
    }

    protected function getName($alias, $type, $isDefault)
    {
        return $isDefault ? sprintf('anh_paginator_%s', $type) : sprintf('anh_paginator_%s_%s', $alias, $type);
    }
}
