<?php

namespace Anh\PaginatorBundle;

class PaginatorViewResolver
{
    protected $views;

    public function addView(PaginatorViewInterface $view, $alias)
    {
        $this->views[$alias] = $view;
    }

    public function getViews()
    {
        return $this->views;
    }

    public function resolve($alias)
    {
        if (!isset($this->views[$alias])) {
            throw new \InvalidArgumentException(
                sprintf("Paginator view '%s' not found.", $alias)
            );
        }

        return $this->views[$alias];
    }
}
