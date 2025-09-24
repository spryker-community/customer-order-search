<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch\Communication\Plugin\Publisher;

use SprykerCommunity\Zed\CustomerOrderSearch\Business\CustomerOrderSearchFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;
use SprykerCommunity\Shared\ProductPageSearch\CustomerOrderSearchConstants;

/**
 * Publishes orders to Elasticsearch when sales_order changes.
 *
 * @method CustomerOrderSearchFacadeInterface getFacade
 */
class OrderWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    public function getSubscribedEvents(): array
    {
        return [
            CustomerOrderSearchConstants::PUBLISH_CUSTOMER_ORDER_EVENT,
//            'Entity.spy_sales_order.create',
//            'Entity.spy_sales_order.update',
//            'Entity.spy_sales_order_item.create',
//            'Entity.spy_sales_order.update',
        ];
    }

    /**
     * @param array $eventEntityTransfers
     * @param $eventName
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $orderIds = [];
        foreach ($eventEntityTransfers as $eventEntityTransfer) {
            $orderIds[] = $eventEntityTransfer->getIdSalesOrder();
        }

        $this->getFacade()->publishOrders($orderIds);
    }
}
