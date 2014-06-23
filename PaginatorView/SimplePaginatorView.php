<?php

namespace Anh\PaginatorBundle\PaginatorView;

use Anh\Paginator\View\SimpleView;
use Anh\PaginatorBundle\PaginatorViewInterface;

class SimplePaginatorView extends SimpleView implements PaginatorViewInterface
{
    use PaginatorViewTrait;
}
