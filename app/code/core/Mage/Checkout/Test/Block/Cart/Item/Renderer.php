<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Mage_Checkout
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * @magentoDataFixture Mage/Catalog/_files/product_with_image.php
 */
class Mage_Checkout_Test_Block_Cart_Item_Renderer extends Mage_Test_Unit_Case
{
    /**
     * @var Mage_Checkout_Block_Cart_Item_Renderer
     */
    protected $_block;

    protected function setUp()
    {
        $this->_block = new Mage_Checkout_Block_Cart_Item_Renderer();
        $item = new Mage_Sales_Model_Quote_Item();
        $product = new Mage_Catalog_Model_Product();
        $product->load(1);
        $item->setProduct($product);
        $this->_block->setItem($item);
    }

    public function testThumbnail()
    {
        $size = $this->_block->getThumbnailSize();
        $sidebarSize = $this->_block->getThumbnailSidebarSize();
        $this->assertGreaterThan(1, $size);
        $this->assertGreaterThan(1, $sidebarSize);
        $this->assertContains('/'.$size, $this->_block->getProductThumbnailUrl());
        $this->assertContains('/'.$sidebarSize, $this->_block->getProductThumbnailSidebarUrl());
        $this->assertStringEndsWith('magento_image.jpg', $this->_block->getProductThumbnailUrl());
        $this->assertStringEndsWith('magento_image.jpg', $this->_block->getProductThumbnailSidebarUrl()
        );
    }
}
