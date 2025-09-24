<?php

namespace SprykerCommunity\Yves\CustomerOrderSearch\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerCommunity\Yves\CustomerOrderSearch\CustomerOrderSearchFactory getFactory()
 */
class ProductDetailCustomerOrderWidget extends AbstractWidget
{
    /**
     * @param string $sku
     */
    public function __construct(string $sku)
    {
        $this->addParameter('sku', $sku)
            ->addParameter('orders', $this->getFactory()->getCustomerOrderSearchClient()->searchByConcrete($sku));
    }

    public static function getName(): string
    {
        return 'ProductDetailCustomerOrderWidget';
    }

    public static function getTemplate(): string
    {
        return '@CustomerOrderSearch/views/product-order-suggest/product-order-suggest.twig';
    }

}
