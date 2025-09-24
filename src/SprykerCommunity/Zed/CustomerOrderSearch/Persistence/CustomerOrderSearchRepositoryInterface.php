<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\CustomerOrderSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;

interface CustomerOrderSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $salesOrderIds
     *
     * @return array<\Generated\Shared\Transfer\SynchronizationDataTransfer>
     */
    public function getSynchronizationDataTransfersByMerchantIds(
        FilterTransfer $filterTransfer,
        array $salesOrderIds = [],
    ): array;
}
