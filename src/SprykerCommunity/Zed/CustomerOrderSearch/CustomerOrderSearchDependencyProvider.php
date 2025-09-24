<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch;

use Spryker\Client\Search\SearchClientInterface;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerOrderSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_SALES = 'FACADE_SALES';
    public const FACADE_SEARCH = 'FACADE_SEARCH';
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';
    public const FACADE_EVENT = 'FACADE_EVENT';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addSalesFacade($container);
        $container = $this->addSearchFacade($container);
        $container = $this->addSearchClient($container);

        return $container;
    }

    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addEventFacade($container);

        return $container;
    }


    private function addSalesFacade(Container $container): Container
    {
        $container->set(self::FACADE_SALES, function (Container $container) {
            return $container->getLocator()->sales()->facade();
        });

        return $container;
    }

    private function addEventFacade(Container $container): Container
    {
        $container->set(self::FACADE_EVENT, function (Container $container) {
            return $container->getLocator()->event()->facade();
        });

        return $container;
    }

    private function addSearchFacade(Container $container): Container
    {
        $container->set(self::FACADE_SEARCH, function (Container $container) {
            return $container->getLocator()->search()->facade();
        });

        return $container;
    }
    private function addSearchClient(Container $container): Container
    {
        $container->set(self::CLIENT_SEARCH, function (Container $container): SearchClientInterface {
            return $container->getLocator()->search()->client();
        });

        return $container;
    }
}
