<?php

namespace Anh\PaginatorBundle\PaginatorView;

use Anh\Paginator\View\HiddenView;
use Anh\PaginatorBundle\PaginatorViewInterface;

class HiddenPaginatorView extends HiddenView implements PaginatorViewInterface
{
    use PaginatorViewTrait;
}
