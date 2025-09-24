<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch\Communication\Plugin\Sales;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use SprykerCommunity\Shared\CustomerOrderSearch\CustomerOrderSearchConstants;
use SprykerCommunity\Zed\CustomerOrderSearch\Communication\CustomerOrderSearchCommunicationFactory;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderPostSavePluginInterface;

/**
 * Fires an event after a sales order has been saved.
 *
 * @method CustomerOrderSearchCommunicationFactory getFactory()
 */
class CustomerOrderSearchPostSavePublishPlugin extends AbstractPlugin implements OrderPostSavePluginInterface
{
    /**
     * @param SaveOrderTransfer $saveOrderTransfer
     * @param QuoteTransfer $quoteTransfer
     * @return SaveOrderTransfer
     */
    public function execute(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer
    {
        $this->getFactory()->getEventFacade()->trigger(
            CustomerOrderSearchConstants::PUBLISH_CUSTOMER_ORDER_EVENT,
            $saveOrderTransfer,
        );

        return $saveOrderTransfer;
    }
}
