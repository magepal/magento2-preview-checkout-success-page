<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 * https://www.magepal.com | support@magepal.com
 */

namespace MagePal\PreviewCheckoutSuccessPage\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use MagePal\PreviewCheckoutSuccessPage\Model\Config\Backend\ValidFor;

/**
 * Class Data
 * @package MagePal\PreviewCheckoutSuccessPage\Helper
 */
class Data extends AbstractHelper
{
    const XML_PATH_ACTIVE = 'magepal_checkout/preview_success_page/active';

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
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
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ACTIVE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     *
     * @return string
     */
    public function getAccessCode()
    {
        return $this->scopeConfig->getValue(
            'magepal_checkout/preview_success_page/access_code',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     *
     * @return string
     */
    public function getOrderIncrement()
    {
        return $this->scopeConfig->getValue(
            'magepal_checkout/preview_success_page/order_increment',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     *
     * @return integer
     */
    public function getValidFor()
    {
        $value = $this->scopeConfig->getValue(
            'magepal_checkout/preview_success_page/valid_for',
            ScopeInterface::SCOPE_STORE
        );

        if ($value < ValidFor::MIN_ACCESS_TIME) {
            $value = ValidFor::MIN_ACCESS_TIME;
        } elseif ($value > ValidFor::MAX_ACCESS_TIME) {
            $value = ValidFor::MAX_ACCESS_TIME;
        }

        return $value;
    }

    /**
     * @return mixed
     */
    public function getModifyTimestamp()
    {
        return $this->scopeConfig->getValue(
            'magepal_checkout/preview_success_page/modify_timestamp',
            ScopeInterface::SCOPE_STORE
        );
    }
}
