<?php

declare(strict_types = 1);

namespace SprykerCommunity\Shared\ProductPageSearch;

use Spryker\Shared\Kernel\AbstractSharedConfig;

class CustomerOrderSearchConfig extends AbstractSharedConfig
{
    /**
     * Defines queue name for publish.
     *
     * @var string
     */
    public const PUBLISH_CUSTOMER_ORDER = 'publish.customer_order';
}
