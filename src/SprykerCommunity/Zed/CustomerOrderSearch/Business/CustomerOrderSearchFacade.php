<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch\Business;

use Generated\Shared\Transfer\ElasticsearchSearchContextTransfer;
use Generated\Shared\Transfer\OrderConditionsTransfer;
use Generated\Shared\Transfer\OrderCriteriaTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\SearchContextTransfer;
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
            'id_sales_order' => $orderTransfer->getIdSalesOrder(),
        ];

        foreach ($orderTransfer->getItems() as $orderItemTransfer) {
            $data['skus'][] = $orderItemTransfer->getSku();
            $data['abstractSkus'][] = $orderItemTransfer->getAbstractSku();
            $data['names'][] = $orderItemTransfer->getName();
        }

        $index = 'hackathon-2025_de_page';
        $elasticSearchContext = new ElasticsearchSearchContextTransfer();
        $elasticSearchContext->setIndexName($index);
        $searchContextTransfer = new SearchContextTransfer();
        $searchContextTransfer->setElasticsearchContext($elasticSearchContext);

        $searchDataTransfer = new SearchDocumentTransfer();
        $searchDataTransfer->setSearchContext($searchContextTransfer);
        $searchDataTransfer->setType('customer_order');
        $searchDataTransfer->setStoreName(Store::getInstance());
        $searchDataTransfer->setData($data);
        $this->getFactory()->getSearchClient()->writeDocument($searchDataTransfer);
    }
}
