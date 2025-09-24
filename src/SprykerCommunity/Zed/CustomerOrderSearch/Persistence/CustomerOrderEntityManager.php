<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\CustomerOrderSearch\Persistence;

use Generated\Shared\Transfer\CustomerOrderSearchCollectionTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;

/**
 * @method \SprykerCommunity\Zed\CustomerOrderSearch\Persistence\CustomerOrderSearchPersistenceFactory getFactory()
 */
class CustomerOrderEntityManager extends AbstractEntityManager implements CustomerOrderSearchEntityManagerInterface
{
    public function deleteCustomerOrderSearchBySalesOrderIds(array $salesOrderIds): void
    {
        $customerOrderSearchCollection = $this->getFactory()
            ->getCustomerOrderSearchPropelQuery()
            ->filterByFkSalesOrder($salesOrderIds)
            ->find();

        $customerOrderSearchCollection->delete();
    }

    public function saveCollection(CustomerOrderSearchCollectionTransfer $customerOrderSearchCollectionTransfer): void
    {
        $customerOrderSearchTransferIdSalesOrderMap = [];

        foreach ($customerOrderSearchCollectionTransfer->getCustomerOrders() as $customerOrderSearchTransfer) {
            $customerOrderSearchTransferIdSalesOrderMap[$customerOrderSearchTransfer->getIdSalesOrder()] = $customerOrderSearchTransfer;
        }

        $customerOrderSearchEntityCollection = $this->getFactory()
            ->getCustomerOrderSearchPropelQuery()
            ->filterByFkSalesOrder(array_keys($customerOrderSearchTransferIdSalesOrderMap), Criteria::IN)
            ->find();

        $customerOrderSearchMapper = $this->getFactory()->createCustomerOrderSearchMapper();

        foreach ($customerOrderSearchEntityCollection as $customerOrderSearchEntity) {
            $customerOrderSearchEntity = $customerOrderSearchMapper->mapMerchantSearchTransferToMerchantSearchEntity(
                $customerOrderSearchTransferIdSalesOrderMap[$customerOrderSearchEntity->getFkSalesOrder()],
                $customerOrderSearchEntity,
            );

            unset($customerOrderSearchTransferIdSalesOrderMap[$customerOrderSearchEntity->getFkSalesOrder()]);
        }

        foreach ($customerOrderSearchTransferIdSalesOrderMap as $customerOrderSearchTransfer) {
            $customerOrderSearchEntity = $customerOrderSearchMapper->mapCustomerOrderSearchTransferToCustomerOrderSearchEntity(
                $customerOrderSearchTransfer,
                new SpyCustomerOrderSearch(),
            );

            $customerOrderSearchEntityCollection->append($customerOrderSearchEntity);
        }

        $customerOrderSearchEntityCollection->save();
    }
}
