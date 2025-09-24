<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch\Business;

use Generated\Shared\Transfer\OrderTransfer;

interface CustomerOrderSearchFacadeInterface
{

    public function publishOrder(OrderTransfer $orderTransfer): void;

    /**
     * @param array<int> $orderIds
     */
    public function publishOrders(array $orderIds = []): void;
}
