<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch\Business;

use Generated\Shared\Transfer\OrderConditionsTransfer;
use Generated\Shared\Transfer\OrderCriteriaTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\SearchDocumentTransfer;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerCommunity\Zed\CustomerOrderSearch\Business\CustomerOrderSearchBusinessFactory getFactory()
 */
class CustomerOrderSearchFacade extends AbstractFacade implements CustomerOrderSearchFacadeInterface
{
    /**
     * @param array<int> $orderIds
     */
    public function publishOrders(array $orderIds): void
    {
        $orderCriteriaTransfer = new OrderCriteriaTransfer();
        $orderConditionsTransfer = new OrderConditionsTransfer();
        $orderConditionsTransfer->setSalesOrderIds($orderIds);
        $orderCriteriaTransfer->setOrderConditions($orderConditionsTransfer);

        $orders = $this->getFactory()
            ->getSalesFacade()
            ->getOrderCollection($orderCriteriaTransfer);

        foreach ($orders as $orderTransfer) {
            $this->publishOrder($orderTransfer);
        }
    }

    public function publishOrder(OrderTransfer $orderTransfer): void
    {
        $data = [
            'customer_reference' => $orderTransfer->getCustomerReference(),
            'order_created_at' => $orderTransfer->getCreatedAt(),
            'order_reference' => $orderTransfer->getOrderReference(),
        ];

        foreach ($orderTransfer->getItems() as $orderItemTransfer) {
            $data['skus'] = $orderItemTransfer->getSku();
            $data['abstractSkus'] = $orderItemTransfer->getAbstractSku();
            $data['names'] = $orderItemTransfer->getName();
        }

        $searchDataTransfer = new SearchDocumentTransfer();
        $searchDataTransfer->setStoreName(Store::getInstance());
        $searchDataTransfer->setData($data);
        $this->getFactory()->getSearchClient()->writeDocument($searchDataTransfer);
    }
}
