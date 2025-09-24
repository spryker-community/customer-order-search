<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch\Business;

use SprykerCommunity\Zed\CustomerOrderSearch\CustomerOrderSearchDependencyProvider;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class CustomerOrderSearchBusinessFactory extends AbstractBusinessFactory
{
    public function getSalesFacade(): SalesFacadeInterface
    {
        return $this->getProvidedDependency(CustomerOrderSearchDependencyProvider::FACADE_SALES);
    }

    public function getSearchClient(): SearchClientInterface
    {
        return $this->getProvidedDependency(CustomerOrderSearchDependencyProvider::CLIENT_SEARCH);
    }
}
