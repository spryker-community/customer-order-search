<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Yves\CustomerOrderSearch\Plugin;

use Generated\Shared\Transfer\TabMetaDataTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;
use SprykerCommunity\Yves\CustomerOrderSearch\Plugin\Router\CustomerOrderSearchRouteProviderPlugin;
use SprykerShop\Yves\TabsWidgetExtension\Plugin\FullTextSearchTabPluginInterface;

/**
 * @method \SprykerShop\Yves\CustomerOrderSearch\CustomerOrderSearchFactory getFactory()
 */
class FullTextSearchOrderPageTabPlugin extends AbstractPlugin implements FullTextSearchTabPluginInterface
{
    /**
     * @var string
     */
    protected const NAME = 'FullTextSearchOrderPage';

    /**
     * @var string
     */
    protected const TAB_TRANSLATED_TITLE = 'Orders'; //TODO replace with glossary key

    /**
     * {@inheritDoc}
     *  - Calculates total hist for order pages tab via OrderPageSearch client module's method call
     *
     * @api
     *
     * @param string $searchString
     * @param array<string, mixed> $requestParams
     *
     * @return int
     */
    public function calculateItemCount(string $searchString, array $requestParams = []): int
    {
        return 1;
        // TODO
        //return $this
        //    ->getFactory()
        //    ->getOrderPageSearchClient()
        //    ->searchCount($searchString, $requestParams);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TabMetaDataTransfer
     */
    public function getTabMetaData(): TabMetaDataTransfer
    {
        $tabsMetaDataTransfer = (new TabMetaDataTransfer())
            ->setName(static::NAME)
            ->setTitle(static::TAB_TRANSLATED_TITLE)
            ->setRoute(CustomerOrderSearchRouteProviderPlugin::ROUTE_NAME_SEARCH);

        return $tabsMetaDataTransfer;
    }
}
