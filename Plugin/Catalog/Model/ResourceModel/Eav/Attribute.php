<?php
/**
 * Copyright © PART <info@part-online.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Part\Decimal\Plugin\Catalog\Model\ResourceModel\Eav;

class Attribute
{
    public function beforeSave(\Magento\Catalog\Model\ResourceModel\Eav\Attribute $subject)
    {
        $data = $subject->getData();
        if (isset($data['frontend_input']) &&
            $data['frontend_input'] === \Part\Decimal\Model\Decimal::DECIMAL_TYPE_ATTRIBUTE_FRONTEND_INPUT) {
            $data['backend_type'] = 'decimal';
            $data['frontend_input_renderer'] = '\Magento\Framework\Data\Form\Element\Text';
            $subject->setData($data);
        }
    }
}
