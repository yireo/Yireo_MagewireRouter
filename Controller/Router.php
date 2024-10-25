<?php declare(strict_types=1);

namespace Yireo\MagewireRouter\Controller;

use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magewirephp\Magewire\Controller\Post\LivewireFactory as ControllerFactory;

class Router implements RouterInterface
{
    public function __construct(
        private ControllerFactory $controllerFactory,
    ) {
    }

    public function match(RequestInterface $request)
    {
        /** @var Http $request */
        if (false === strstr($request->getRequestUri(), 'magewire/post/livewire')) {
            return false;
        }

        $request->setControllerModule('magewire');
        $request->setModuleName('post');
        $request->setActionName('livewire');
        $request->setDispatched(true);

        return $this->controllerFactory->create();
    }
}
