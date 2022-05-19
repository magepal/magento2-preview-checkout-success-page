<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 * https://www.magepal.com | support@magepal.com
 */
namespace MagePal\PreviewCheckoutSuccessPage\Plugin\Model\Session;

use Magento\Checkout\Model\Session;
use Magento\Checkout\Model\Session\SuccessValidator;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use MagePal\PreviewCheckoutSuccessPage\Helper\Data;

class SuccessValidatorPlugin
{
    /** @var Data */
    protected $dataHelper;

    /** @var RequestInterface */
    protected $request;

    /**
     * @var Session
     */
    protected $checkoutSession;

    /**
     * @var CollectionFactory
     */
    protected $orderCollectionFactory;

    /**
     * @var TimezoneInterface
     */
    private $localeDate;

    /**
     * @param Data $dataHelper
     * @param RequestInterface $request
     * @param Session $checkoutSession
     * @param CollectionFactory $orderCollectionFactory
     */
    public function __construct(
        Data $dataHelper,
        RequestInterface $request,
        Session $checkoutSession,
        CollectionFactory $orderCollectionFactory
    ) {
        $this->dataHelper = $dataHelper;
        $this->request = $request;
        $this->checkoutSession = $checkoutSession;
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    /**
     * @param SuccessValidator $subject
     * @param $result
     * @return bool
     */
    public function afterIsValid(SuccessValidator $subject, $result)
    {
        if ($this->dataHelper->isEnabled()
            && $this->isValidAccessCode()
            && $this->dataHelper->getOrderIncrement()
        ) {
            /** @var Order $order */
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

    /**
     * @param $increment_id
     * @return DataObject
     */
    public function getOrderByIncrementId($increment_id)
    {
        $collection = $this->orderCollectionFactory->create();
        $collection->addFieldToFilter('increment_id', $increment_id)
            ->setPageSize(1)
            ->setCurPage(1);
        return $collection->getFirstItem();
    }

    /**
     * @return bool
     */
    protected function isValidAccessCode()
    {
        $accessCode = $this->request->getParam('previewAccessCode', null);
        $validUntil = $this->dataHelper->getModifyTimestamp() + 60 * $this->dataHelper->getValidFor();

        if ($accessCode
            && $accessCode === $this->dataHelper->getAccessCode()
            && $validUntil > $this->dataHelper->getTimeStamp()
        ) {
            return true;
        }

        return false;
    }
}
