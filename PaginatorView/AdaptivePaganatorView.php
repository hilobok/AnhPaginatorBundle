<?php

namespace Anh\PaginatorBundle\PaginatorView;

use Anh\Paginator\View\AdaptiveView;
use Anh\PaginatorBundle\PaginatorViewInterface;

class AdaptivePaginatorView extends AdaptiveView implements PaginatorViewInterface
{
    use PaginatorViewTrait;
}
