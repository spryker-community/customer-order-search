<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch\Communication;

use SprykerCommunity\Zed\CustomerOrderSearch\CustomerOrderSearchDependencyProvider;
use Spryker\Zed\Event\Business\EventFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class CustomerOrderSearchCommunicationFactory extends AbstractCommunicationFactory
{
    public function getEventFacade(): EventFacadeInterface
    {
        return $this->getProvidedDependency(CustomerOrderSearchDependencyProvider::FACADE_EVENT);
    }
}
