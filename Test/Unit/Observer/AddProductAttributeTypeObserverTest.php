<?php
/**
 * Copyright © PART <info@part-online.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Part\Decimal\Test\Unit\Observer;

class AddProductAttributeTypeObserverTest extends \PHPUnit_Framework_TestCase
{
    private $eventObserverMock;

    private $observer;

    public function setUp()
    {
        $this->eventObserverMock = $this->getMock('\Magento\Framework\Event\Observer', ['getResponse'], [], '', false);
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->observer = $objectManager->getObject('Part\Decimal\Observer\AddProductAttributeTypeObserver', []);
    }

    public function testExecute()
    {
        $responseMock = $this->getMock('\Magento\Framework\DataObject', ['getTypes', 'setTypes'], [], '', false);
        $responseMock
            ->expects($this->once())
            ->method('getTypes')
            ->willReturn(['someType']);
        $responseMock
            ->expects($this->once())
            ->method('setTypes')
            ->with(
                [
                    'someType',
                    [
                        'value' => \Part\Decimal\Model\Decimal::DECIMAL_TYPE_ATTRIBUTE_FRONTEND_INPUT,
                        'label' => __('Decimal'),
                        'hide_fields' => [],
                    ],
                ]
            );
        $this->eventObserverMock
            ->expects($this->once())
            ->method('getResponse')
            ->willReturn($responseMock);
        $this->observer->execute($this->eventObserverMock);
    }
}
