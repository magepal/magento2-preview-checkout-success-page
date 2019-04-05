<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 * https://www.magepal.com | support@magepal.com
 */

/**
 * Form text element
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace MagePal\PreviewCheckoutSuccessPage\Block\Adminhtml\System\Config\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\DataObject;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Store\Api\Data\StoreInterface;

/**
 * Class OrderIncrement
 * @package MagePal\PreviewCheckoutSuccessPage\Block\Adminhtml\System\Config\Form\Field
 */
class OrderIncrement extends Field
{

    /**
     * @var CollectionFactory
     */
    protected $orderCollectionFactory;

    /**
     * OrderIncrement constructor.
     * @param Context $context
     * @param CollectionFactory $orderCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $orderCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    /**
     * Get the grid and scripts contents
     *
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $this->setElement($element);

        if (!$element->getEscapedValue()) {

            /** @var Order $order */
            $order = $this->getLastOrder();

            if ($order->getId()) {
                $element->setValue($order->getIncrementId());
            }
        }

        return parent::_getElementHtml($element);
    }

    /**
     * @return StoreInterface|null
     */
    public function getCurrentStore()
    {
        $form = $this->getElement()->getForm();
        if ($form->getStoreCode()) {
            $store = $this->_storeManager->getStore($form->getStoreCode());
        } elseif ($form->getWebsiteCode()) {
            $store = $this->_storeManager->getWebsite($form->getWebsiteCode())->getDefaultStore();
        } else {
            $store = $this->_storeManager->getDefaultStoreView();
        }

        return $store;
    }

    /**
     * @return DataObject
     */
    public function getLastOrder()
    {
        $store = $this->getCurrentStore();
        $collection = $this->orderCollectionFactory->create();
        $collection->addFieldToFilter('store_id', $store->getId())
            ->setOrder('entity_id', 'DESC')
            ->setPageSize(1)
            ->setCurPage(1);

        return $collection->getFirstItem();
    }
}
