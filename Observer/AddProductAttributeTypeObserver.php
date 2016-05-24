<?php
/**
 * Copyright © PART <info@part-online.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Part\Decimal\Observer;

class AddProductAttributeTypeObserver implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $response = $observer->getResponse();
        $types = $response->getTypes();
        $types[] = [
            'value' => \Part\Decimal\Model\Decimal::DECIMAL_TYPE_ATTRIBUTE_FRONTEND_INPUT,
            'label' => __('Decimal'),
            'hide_fields' => [],
        ];

        $response->setTypes($types);
    }
}
