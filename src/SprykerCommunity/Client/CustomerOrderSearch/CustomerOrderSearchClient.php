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

        return $this->getFactory()
            ->getSearchClient()
            ->search($searchQuery, [new RawCatalogSearchResultFormatterPlugin()], $requestParameters);



        // TODO: Implement search() method.
        return [
            [
                'id_sales_order' => '1',
                'customer_reference' => 'DE-123456',
                'order_created_at' => new \DateTime('22.09.2025 13:00:00'),
                'order_reference' => '890',
                'skus' => [
                    '123','234','345'
                ],
                'abstractSkus'=> [
                    'abstract-123','abstract-234','abstract-345'
                ],
                'names'=> [
                    'Tisch', 'Fisch', 'Lampe'
                ],
            ],
            [
                'id_sales_order' => '2',
                'customer_reference' => 'DE-123456',
                'order_created_at' => new \DateTime('20.09.2025 13:00:00'),
                'order_reference' => '895',
                'skus' => [
                    '123','234','345'
                ],
                'abstractSkus'=> [
                    'abstract-123','abstract-234','abstract-345'
                ],
                'names'=> [
                    'Tisch', 'Fisch', 'Lampe'
                ],
            ],
            [
                'id_sales_order' => '3',
                'customer_reference' => 'DE-123456',
                'order_created_at' => new \DateTime('18.09.2025 13:00:00'),
                'order_reference' => '893',
                'skus' => [
                    '123','234','345'
                ],
                'abstractSkus'=> [
                    'abstract-123','abstract-234','abstract-345'
                ],
                'names'=> [
                    'Tisch', 'Fisch', 'Lampe'
                ],
            ],
            [
                'id_sales_order' => '4',
                'customer_reference' => 'DE-123456',
                'order_created_at' => new \DateTime('22.08.2025 13:00:00'),
                'order_reference' => '892',
                'skus' => [
                    '123','234','345'
                ],
                'abstractSkus'=> [
                    'abstract-123','abstract-234','abstract-345'
                ],
                'names'=> [
                    'Tisch', 'Fisch', 'Lampe'
                ],
            ],
        ];
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
