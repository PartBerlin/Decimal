<?php
/**
 * Copyright © PART <info@part-online.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Part\Decimal\Test\Unit\Controller\Adminhtml\Product\Attribute\Plugin;

class SaveTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataBeforeDispatch
     */
    public function testBeforeDispatch($dataRequest, $runTimes)
    {
        $subject = $this->getMock('\Magento\Catalog\Controller\Adminhtml\Product\Attribute\Save', [], [], '', false);
        $request = $this->getMock(
            '\Magento\Framework\App\RequestInterface',
            [
                'getPostValue',
                'setPostValue',
                'getModuleName',
                'setModuleName',
                'getActionName',
                'setActionName',
                'getParam',
                'setParams',
                'getParams',
                'getCookie',
                'isSecure'
            ],
            [],
            '',
            false
        );

        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $controller = $objectManager->getObject('\Part\Decimal\Controller\Adminhtml\Product\Attribute\Plugin\Save');

        $request->expects($this->once())->method('getPostValue')->willReturn($dataRequest);
        $request->expects($this->exactly($runTimes))->method('setPostValue')->willReturn($this->returnSelf());

        $controller->beforeDispatch($subject, $request);
    }

    public function dataBeforeDispatch()
    {
        return [
            [
                ['frontend_input' => 'decimal'],
                1,
            ],
            [
                ['frontend_input' => 'text'],
                0,
            ],
            [
                [],
                0,
            ],
            [
                null,
                0,
            ],
        ];
    }
}
