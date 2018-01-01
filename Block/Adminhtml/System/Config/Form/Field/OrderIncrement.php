<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Form text element
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace MagePal\PreviewCheckoutSuccessPage\Block\Adminhtml\System\Config\Form\Field;

class OrderIncrement extends \Magento\Config\Block\System\Config\Form\Field
{

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $orderCollectionFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    /**
     * Get the grid and scripts contents
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $this->setElement($element);

        if (!$element->getEscapedValue()) {

            /** @var \Magento\Sales\Model\Order $order */
            $order = $this->getLastOrder();

            if ($order->getId()) {
                $element->setValue($order->getIncrementId());
            }
        }

        return parent::_getElementHtml($element);
    }

    /**
     * @return \Magento\Store\Api\Data\StoreInterface|null
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
     * @return \Magento\Framework\DataObject
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
