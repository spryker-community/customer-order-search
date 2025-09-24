<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Client\CustomerOrderSearch;

use Spryker\Client\Kernel\AbstractClient;

class CustomerOrderSearchClient extends AbstractClient implements CustomerOrderSearchClientInterface
{
    /**
     * @inheritDoc
     */
    public function search(string $searchString, array $requestParameters): array
    {
        // TODO: Implement search() method.
        return [];
    }

    /**
     * @inheritDoc
     */
    public function searchCount(string $searchString, array $requestParameters): int
    {
        return 1;
    }
}
