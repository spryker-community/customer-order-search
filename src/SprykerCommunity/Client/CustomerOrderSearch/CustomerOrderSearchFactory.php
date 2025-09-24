<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Client\CustomerOrderSearch;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchStringSetterInterface;
use SprykerCommunity\Client\CustomerOrderSearch\Plugin\Elasticsearch\Query\CustomerOrderSearchQueryPlugin;

class CustomerOrderSearchFactory extends AbstractFactory
{
    public function createCustomerOrderSearchQuery(string $searchString): QueryInterface
    {
        $customerOrderSearchQueryPlugin = new CustomerOrderSearchQueryPlugin();

        if ($customerOrderSearchQueryPlugin instanceof SearchStringSetterInterface) {
            $customerOrderSearchQueryPlugin->setSearchString($searchString);
        }

        return $customerOrderSearchQueryPlugin;
    }

    /**
     * @return \Spryker\Client\Search\SearchClientInterface
     */
    public function getSearchClient(): SearchClientInterface
    {
        return $this->getProvidedDependency(CustomerOrderSearchDependencyProvider::CLIENT_SEARCH);
    }
}
