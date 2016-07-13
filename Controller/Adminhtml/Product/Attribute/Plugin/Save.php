<?php
/**
 * Copyright © PART <info@part-online.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Part\Decimal\Controller\Adminhtml\Product\Attribute\Plugin;

use Magento\Catalog\Controller\Adminhtml\Product\Attribute;
use Magento\Framework\App\RequestInterface;
use Part\Decimal\Model\Decimal;

class Save
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeDispatch(Attribute\Save $subject, RequestInterface $request)
    {
        $data = $request->getPostValue();
        if (isset($data['frontend_input']) &&
            $data['frontend_input'] === Decimal::DECIMAL_TYPE_ATTRIBUTE_FRONTEND_INPUT) {
            $data[Decimal::DECIMAL_INPUT_TYPE_KEY] = Decimal::DECIMAL_TYPE_ATTRIBUTE_FRONTEND_INPUT;
            $data['frontend_input'] = 'text';
            $request->setPostValue($data);
        }
        return [$request];
    }
}
