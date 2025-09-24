<?php

declare(strict_types = 1);

namespace SprykerCommunity\Shared\ProductPageSearch;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
class CustomerOrderSearchConstants
{
    /**
     * Specification:
     * - Queue name as used for processing order messages
     *
     * @api
     *
     * @var string
     */
    public const CUSTOMER_ORDER_SYNC_SEARCH_QUEUE = 'sync.customer-order.product';

    /**
     * Specification:
     * - Queue name as used for processing Product messages
     *
     * @api
     *
     * @var string
     */
    public const CUSTOMER_ORDER_SYNC_SEARCH_ERROR_QUEUE = 'sync.search.customer-order.error';

    /**
     * Specification:
     * - Resource name, this will use for key generating
     *
     * @api
     *
     * @var string
     */
    public const CUSTOMER_ORDER_RESOURCE_NAME = 'customer_order';

    /**
     * Event name for publishing customer order
     */
    public const PUBLISH_CUSTOMER_ORDER_EVENT = 'publish.customer-order.event';
}
