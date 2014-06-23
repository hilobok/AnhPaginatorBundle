<?php

namespace Anh\PaginatorBundle\Twig;

use Anh\Paginator\PageInterface;
use Anh\PaginatorBundle\PaginatorViewRenderer;

class PaginatorExtension extends \Twig_Extension
{
    protected $viewRenderer;

    /**
     * Constructor
     */
    public function __construct(PaginatorViewRenderer $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'anh_paginator_view' => new \Twig_Function_Method($this, 'view', array('is_safe' => array('html'))),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'anh_paginator';
    }

    /**
     * Renders paginator view.
     * @param  PageInterface $page    Page instance for render.
     * @param  string        $alias   Paginator view alias.
     * @param  string        $url     Pagination url.
     * @param  array         $options Paginator view options.
     * @return string                 Rendered paginator view.
     */
    public function view(PageInterface $page, $alias = null, $url = null, array $options = array())
    {
        return $this->viewRenderer->render($page, $alias, $url, $options);
    }
}
