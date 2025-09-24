<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\CustomerOrderSearch\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \SprykerCommunity\Zed\CustomerOrderSearch\CustomerOrderSearchConfig getConfig()
 * @method \SprykerCommunity\Zed\CustomerOrderSearch\Persistence\CustomerOrderSearchEntityManagerInterface getEntityManager()
 * @method \SprykerCommunity\Zed\CustomerOrderSearch\Persistence\CustomerOrderSearchRepositoryInterface getRepository()
 */

class CustomerOrderSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CustomerOrderSearch\Persistence\SpyCustomerOrderSearchQuery
     */
    public function getCustomerOrderSearchPropelQuery(): SpyCustomerOrderSearchQuery
    {
        return SpyCustomerOrderSearchQuery::create();
    }

    /**
     * @return \SprykerCommunity\Zed\CustomerOrderSearch\Persistence\Propel\Mapper\CustomerOrderSearchMapper
     */
    public function createCustomerOrderSearchMapper(): CustomerOrderSearchMapper
    {
        return new CustomerOrderSearchMapper();
    }
}
