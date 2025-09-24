<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\CustomerOrderSearch\Persistence;

use Generated\Shared\Transfer\CustomerOrderSearchCollectionTransfer;

interface CustomerOrderSearchEntityManagerInterface
{
    /**
     * @param array<int> $salesOrderIds
     *
     * @return void
     */
    public function deleteCustomerOrderSearchBySalesOrderIds(
        array $salesOrderIds,
    ): void;

    /**
     * @param \Generated\Shared\Transfer\CustomerOrderSearchCollectionTransfer $customerOrderSearchCollectionTransfer
     *
     * @return void
     */
    public function saveCollection(
        CustomerOrderSearchCollectionTransfer $customerOrderSearchCollectionTransfer,
    ): void;
}
