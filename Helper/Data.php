<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 * http://www.magepal.com | support@magepal.com
 */

namespace MagePal\PreviewCheckoutSuccessPage\Helper;

use MagePal\PreviewCheckoutSuccessPage\Model\Config\Backend\ValidFor;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_ACTIVE = 'magepal_checkout/preview_success_page/active';

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Whether is active
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ACTIVE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     *
     * @return string
     */
    public function getAccessCode()
    {
        return $this->scopeConfig->getValue('magepal_checkout/preview_success_page/access_code', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     *
     * @return string
     */
    public function getOrderIncrement()
    {
        return $this->scopeConfig->getValue('magepal_checkout/preview_success_page/order_increment', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     *
     * @return integer
     */
    public function getValidFor()
    {
        $value = $this->scopeConfig->getValue('magepal_checkout/preview_success_page/valid_for', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        if ($value < ValidFor::MIN_ACCESS_TIME) {
            $value = ValidFor::MIN_ACCESS_TIME;
        } elseif ($value > ValidFor::MAX_ACCESS_TIME) {
            $value = ValidFor::MAX_ACCESS_TIME;
        }

        return $value;
    }

    public function getModifyTimestamp()
    {
        return $this->scopeConfig->getValue('magepal_checkout/preview_success_page/modify_timestamp', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
