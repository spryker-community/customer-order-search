<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Yves\CustomerOrderSearch;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerCommunity\Client\CustomerOrderSearch\CustomerOrderSearchClientInterface;

class CustomerOrderSearchFactory extends AbstractFactory
{
    /**
     * @return \SprykerCommunity\Client\CustomerOrderSearch\CustomerOrderSearchClientInterface
     */
    public function getCustomerOrderSearchClient(): CustomerOrderSearchClientInterface
    {
        return $this->getProvidedDependency(CustomerOrderSearchDependencyProvider::CLIENT_CLIENT_CUSTOMER_ORDER_SEARCH);
    }
}
