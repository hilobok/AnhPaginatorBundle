<?php

namespace Anh\PaginatorBundle\PaginatorView;

use Anh\Paginator\View\AbstractView;
use Anh\PaginatorBundle\PaginatorViewInterface;

trait PaginatorViewTrait
{
    protected $css;

    protected $js;

    public function setCss($css)
    {
        $this->css = $css;
    }

    public function setJs($js)
    {
        $this->js = $js;
    }

    public function getCss()
    {
        $reflector = new \ReflectionClass('Anh\Paginator\ViewInterface');

        return $this->css ?: array(
            sprintf('%s/../resource/pagination.css', dirname($reflector->getFileName())),
        );
    }

    public function getJs()
    {
        return $this->js ?: array();
    }
}