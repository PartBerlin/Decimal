<?php
/**
 * Copyright © PART <info@part-online.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Part\Decimal\Test\Unit\Plugin\Catalog\Model\ResourceModel\Eav;

class AttributeTest extends \PHPUnit_Framework_TestCase
{
    private $attributeMock;

    private $attributePlugin;

    public function setUp()
    {
        $this->attributeMock = $this->getMock(
            '\Magento\Catalog\Model\ResourceModel\Eav\Attribute',
            ['getData', 'setData'],
            [],
            '',
            false
        );
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->attributePlugin = $objectManager->getObject(
            'Part\Decimal\Plugin\Catalog\Model\ResourceModel\Eav\Attribute',
            []
        );
    }

    /**
     * @dataProvider dataBeforeSave
     */
    public function testBeforeSave(array $getData, $setDataCount, array $setData)
    {
        $this->attributeMock
            ->expects($this->once())
            ->method('getData')
            ->willReturn($getData);
        $this->attributeMock
            ->expects($this->exactly($setDataCount))
            ->method('setData')
            ->with($setData);

        $this->attributePlugin->beforeSave($this->attributeMock);
    }

    public function dataBeforeSave()
    {
        return [
            [
                [],
                0,
                [],
            ],
            [
                ['frontend_input' => 'text'],
                0,
                [],
            ],
            [
                ['frontend_input' => 'decimal'],
                1,
                [
                    'frontend_input' => 'decimal',
                    'backend_type' => 'decimal',
                    'frontend_input_renderer' => '\Magento\Framework\Data\Form\Element\Text'
                ],
            ],
            [
                ['frontend_input' => 'decimal', 'backend_type' => 'static'],
                1,
                [
                    'frontend_input' => 'decimal',
                    'backend_type' => 'decimal',
                    'frontend_input_renderer' => '\Magento\Framework\Data\Form\Element\Text'
                ],
            ],
        ];
    }
}
