<?php
/**
 * Copyright © PART <info@part-online.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Part\Decimal\Plugin\Catalog\Model\ResourceModel\Eav;

use Part\Decimal\Model\Decimal;

class Attribute
{
    public function beforeSave(\Magento\Catalog\Model\ResourceModel\Eav\Attribute $subject)
    {
        $data = $subject->getData();
        if (isset($data[Decimal::DECIMAL_INPUT_TYPE_KEY]) &&
            $data[Decimal::DECIMAL_INPUT_TYPE_KEY] === Decimal::DECIMAL_TYPE_ATTRIBUTE_FRONTEND_INPUT) {
            $data['backend_type'] = 'decimal';
            $data['frontend_input_renderer'] = 'Magento\Framework\Data\Form\Element\Text';
            $subject->setData($data);
        }
    }
}
