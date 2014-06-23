<?php

namespace Anh\PaginatorBundle;

use Anh\Paginator\PageInterface;

class PaginatorViewRenderer
{
    protected $url;

    protected $defaultView;

    public function __construct(PaginatorViewResolver $viewResolver, $defaultView)
    {
        $this->viewResolver = $viewResolver;
        $this->defaultView = $defaultView;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function render(PageInterface $page, $alias = null, $url = null, array $options = array())
    {
        return $this->viewResolver->resolve($alias ?: $this->defaultView)
            ->render($page, $url ?: $this->url, $options);
        ;
    }
}
