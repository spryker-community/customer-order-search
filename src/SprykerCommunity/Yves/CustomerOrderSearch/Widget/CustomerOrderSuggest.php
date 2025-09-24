<?php

namespace SprykerCommunity\Yves\CustomerOrderSearch\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

class CustomerOrderSuggest extends AbstractWidget
{
    /**
     * @var string
     */
    protected const PARAMETER_ORDER_SUGGESTS = 'orderSuggest';

    /**
     * @param array $orderSuggests
     */
    public function __construct(array $orderSuggests)
    {
        $this->addParameter(static::PARAMETER_ORDER_SUGGESTS, $orderSuggests);
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'CustomerOrderSuggest';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@CustomerOrderSearch/views/customer-order-suggest/customer-order-suggest.twig';
    }

}
