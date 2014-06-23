<?php

namespace Anh\PaginatorBundle\EventListener;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Anh\Paginator\UrlGenerator;
use Anh\PaginatorBundle\PaginatorViewRenderer;

class CurrentUrlListener
{
    protected $router;

    protected $viewRenderer;

    /**
     * Page number parameter name.
     * @var string
     */
    protected $parameter;


    public function __construct(RouterInterface $router, PaginatorViewRenderer $viewRenderer, $parameter)
    {
        $this->router = $router;
        $this->viewRenderer = $viewRenderer;
        $this->parameter = $parameter;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();
        $routeParameters = $request->attributes->get('_route_params');

        if (!isset($routeParameters[$this->parameter])) {
            return;
        }

        $dummyPageNumber = str_repeat('0123456789', 11);
        $routeParameters[$this->parameter] = $dummyPageNumber;

        $routeName = $request->attributes->get('_route');

        $url = $this->router->generate($routeName, $routeParameters);
        $url = str_replace($dummyPageNumber, UrlGenerator::PLACEHOLDER, $url);

        $this->viewRenderer->setUrl($url);
    }
}
