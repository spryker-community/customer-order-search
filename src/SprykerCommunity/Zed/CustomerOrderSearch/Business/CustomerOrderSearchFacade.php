<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch\Business;

use Generated\Shared\Transfer\OrderConditionsTransfer;
use Generated\Shared\Transfer\OrderCriteriaTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\SearchContextTransfer;
use Generated\Shared\Transfer\SearchDocumentTransfer;
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

        $orderCollection = $this->getFactory()
            ->getSalesFacade()
            ->getOrderCollection($orderCriteriaTransfer);

        foreach ($orderCollection->getOrders() as $orderTransfer) {
            $this->publishOrder($orderTransfer);
        }
    }

    public function publishOrder(OrderTransfer $orderTransfer): void
    {
        $searchResultData = [
            'customer_reference' => $orderTransfer->getCustomerReference(),
            'order_created_at' => $orderTransfer->getCreatedAt(),
            'order_reference' => $orderTransfer->getOrderReference(),
            'id_sales_order' => $orderTransfer->getIdSalesOrder(),
        ];

        foreach ($orderTransfer->getItems() as $orderItemTransfer) {
            $searchResultData['skus'][] = $orderItemTransfer->getSku();
            $searchResultData['abstractSkus'][] = $orderItemTransfer->getAbstractSku();
            $searchResultData['names'][] = $orderItemTransfer->getName();
        }

        $data = [
            'customer_reference' => $orderTransfer->getCustomerReference(),
            'order_created_at' => $orderTransfer->getCreatedAt(),
            'order_reference' => $orderTransfer->getOrderReference(),
            'id_sales_order' => $orderTransfer->getIdSalesOrder(),
            'skus' => $searchResultData['skus'],
            'abstractSkus' => $searchResultData['abstractSkus'],
            'names' => $searchResultData['names'],
            'store' => $orderTransfer->getStore(),
            'search_result_data' => $searchResultData,
            'type' => 'customer_order',
        ];

        $searchContextTransfer = new SearchContextTransfer();
        $searchContextTransfer->setSourceIdentifier('page');
        $searchContextTransfer->setStoreName($orderTransfer->getStore());

        $searchDataTransfer = new SearchDocumentTransfer();
        $searchDataTransfer->setSearchContext($searchContextTransfer);
        $searchDataTransfer->setId('customer_order:' . $orderTransfer->getIdSalesOrder());
        $searchDataTransfer->setType('customer_order');
        $searchDataTransfer->setStoreName($orderTransfer->getStore());
        $searchDataTransfer->setData($data);
        $this->getFactory()->getSearchClient()->writeDocument($searchDataTransfer);
    }
}
