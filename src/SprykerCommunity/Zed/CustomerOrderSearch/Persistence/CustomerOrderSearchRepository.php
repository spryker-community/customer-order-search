<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\CustomerOrderSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class CustomerOrderSearchRepository extends AbstractRepository implements CustomerOrderSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array $salesOrderIds
     *
     * @return array<\Generated\Shared\Transfer\SynchronizationDataTransfer>
     */
    public function getSynchronizationDataTransfersByMerchantIds(
        FilterTransfer $filterTransfer,
        array $salesOrderIds = [],
    ): array {
        $synchronizationDataTransfers = [];
        $customerOrderSearchEntityCollection = $this->getCustomerOrderSearchEntityCollection(
            $filterTransfer,
            $salesOrderIds,
        );

        foreach ($customerOrderSearchEntityCollection as $customerOrderSearchEntity) {
            $data = $customerOrderSearchEntity->getData();
            $synchronizationDataTransfers[] = (new SynchronizationDataTransfer())
                ->setData($data)
                ->setKey($customerOrderSearchEntity->getKey());
        }

        return $synchronizationDataTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $merchantIds
     *
     * @return \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\CustomerOrderSearch\Persistence\SpyCustomerOrderSearch>
     */
    protected function getCustomerOrderSearchEntityCollection(
        FilterTransfer $filterTransfer,
        array $salesOrderIds
    ): ObjectCollection {
        $customerOrderSearchQuery = $this->getFactory()->getCustomerOrderSearchPropelQuery();

        if ($salesOrderIds) {
            $customerOrderSearchQuery->filterByFkSalesOrder_In($salesOrderIds);
        }

        return $this->buildQueryFromCriteria($customerOrderSearchQuery, $filterTransfer)
            ->setFormatter(ModelCriteria::FORMAT_OBJECT)
            ->find();
    }
}
