<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 * http://www.magepal.com | support@magepal.com
 */
namespace MagePal\PreviewCheckoutSuccessPage\Plugin\Model\Session;

use Magento\Framework\App\Config\ScopeConfigInterface;

class SuccessValidatorPlugin
{

    /** @var \MagePal\PreviewCheckoutSuccessPage\Helper\Data */
    protected $dataHelper;

    /** @var \Magento\Framework\App\RequestInterface */
    protected $request;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $orderCollectionFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $localeDate;

    /**
     * @param \MagePal\PreviewCheckoutSuccessPage\Helper\Data $dataHelper
     */
    public function __construct(
        \MagePal\PreviewCheckoutSuccessPage\Helper\Data $dataHelper,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate
    ) {
        $this->dataHelper = $dataHelper;
        $this->request = $request;
        $this->checkoutSession = $checkoutSession;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->localeDate = $localeDate;
    }

    public function afterIsValid(\Magento\Checkout\Model\Session\SuccessValidator $subject, $result)
    {
        if ($this->dataHelper->isEnabled()
            && $this->isValidAccessCode()
            && $this->dataHelper->getOrderIncrement()
        ) {
            /** @var \Magento\Sales\Model\Order $order */
            $order = $this->getOrderByIncrementId($this->dataHelper->getOrderIncrement());

            if ($order->getId()) {
                $this->checkoutSession
                    ->setLastOrderId($order->getId())
                    ->setLastRealOrderId($order->getIncrementId())
                    ->setLastOrderStatus($order->getStatus());

                return true;
            }
        }

        return $result;
    }

    public function getOrderByIncrementId($increment_id)
    {
        $collection = $this->orderCollectionFactory->create();
        $collection->addFieldToFilter('increment_id', $increment_id)
            ->setPageSize(1)
            ->setCurPage(1);
        return $collection->getFirstItem();
    }

    protected function isValidAccessCode()
    {
        $accessCode = $this->request->getParam('previewAccessCode', null);

        if ($accessCode
            && $accessCode === $this->dataHelper->getAccessCode()
            && ($this->dataHelper->getModifyTimestamp() + 60 * $this->dataHelper->getValidFor())
                > $this->localeDate->scopeTimeStamp(ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
        ) {
            return true;
        }

        return false;
    }
}
