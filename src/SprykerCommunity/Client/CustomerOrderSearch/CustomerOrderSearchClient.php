<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Client\CustomerOrderSearch;

use Spryker\Client\Catalog\Plugin\Elasticsearch\ResultFormatter\RawCatalogSearchResultFormatterPlugin;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerCommunity\Client\CustomerOrderSearch\CustomerOrderSearchFactory getFactory()
 */
class CustomerOrderSearchClient extends AbstractClient implements CustomerOrderSearchClientInterface
{
    /**
     * @inheritDoc
     */
    public function search(string $searchString, array $requestParameters): array
    {
        $searchQuery = $this->getFactory()
            ->createCustomerOrderSearchQuery($searchString);

        $data = $this->getFactory()
            ->getSearchClient()
            ->search($searchQuery, []);

        $results = [];

        /** @var \Elastica\Result $item */
        foreach ($data->getResults() as $item) {
            $rawData = $item->getData();
            $results[] = $rawData['search_result_data'];
        }

        return $results;
    }

    /**
     * @inheritDoc
     */
    public function searchCount(string $searchString, array $requestParameters): int
    {
        // TODO
        return count($this->search($searchString,$requestParameters));
    }

    /**
     * @inheritDoc
     */
    public function searchByConcrete(string $sku): array
    {
        // TODO
        return $this->search($sku, []);
    }
}
