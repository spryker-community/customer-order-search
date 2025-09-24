<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Yves\CustomerOrderSearch;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class CustomerOrderSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_CLIENT_CUSTOMER_ORDER_SEARCH = 'CLIENT_CLIENT_CUSTOMER_ORDER_SEARCH';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addCustomerOrderSearchClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addCustomerOrderSearchClient(Container $container): Container
    {
        $container->set(static::CLIENT_CLIENT_CUSTOMER_ORDER_SEARCH, function (Container $container) {
            return $container->getLocator()->customerOrderSearch()->client();
        });

        return $container;
    }

}
