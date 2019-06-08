<a href="https://www.magepal.com" ><img src="https://image.ibb.co/dHBkYH/Magepal_logo.png" width="100" align="right" /></a>

# Preview Order Confirmation Page for Magento 2

[![Total Downloads](https://poser.pugx.org/magepal/magento2-preview-checkout-success-page/downloads)](https://packagist.org/packages/magepal/magento2-preview-checkout-success-page)
[![Latest Stable Version](https://poser.pugx.org/magepal/magento2-preview-checkout-success-page/v/stable)](https://packagist.org/packages/magepal/magento2-preview-checkout-success-page)

Styling and testing Magento's order confirmation page can be a very difficult and time-consuming process since the order success page display is only displayed once after completing the lengthy checkout process. Changing your page content or testing a new CSS style will automatically redirect you to an empty shopping cart page on page refresh.

Design beautiful order confirmation page with our new [Enhanced Success Page](https://www.magepal.com/magento2/extensions/enhanced-success-page.html) extension.

Our free magento2 extension allows you to quickly test [Google Tag Manager](https://www.magepal.com/magento2/extensions/google-tag-manager.html), [Enhanced Ecommerce](https://www.magepal.com/magento2/extensions/enhanced-ecommerce-for-google-tag-manager.html) or other [miscellaneous HTML, scripts and code snippets](https://www.magepal.com/magento2/extensions/order-confirmation-miscellaneous-scripts-for-magento-2.html). Easily preview and make changes to your success page without placing a new order or modifying Magento's core code, perfect for Magento frontend developers. After installing our extension you can navigate to the module preference in store configuration section and specify an order number and then preview the success page for that order, view HTML source and search for specific javascript snippet or share a link to preview on other devices. For security, the generated link is only valid for a short period of time which can be changed base on your needs.

To avoid tracking of duplicate order information on your live site, you may want to limit usage and testing of our extension to your development environment with [Google Analytics](https://www.magepal.com/magento2/extensions/enhanced-ecommerce-for-google-tag-manager.html) and order tracking script disabled.

![How to test or style the order success page](https://image.ibb.co/h9ssDH/Preview_Checkout_Success_Page_for_Magento.gif)

### Features
- Configure any order number you want to preview from admin.
- Quick and easily view checkout page source, in line within admin or within a new browser window.
- Zero core hacks.
- Created for testing sites but work perfectly on live/production environment.
- Save time when style checkout success page.

### Production usage

This module was intended for development, testing, and staging environment. Please consider carefully before using in a production environment because it may affect your analytics/conversion data.


## Installation

#### Step 1
##### Using Composer (recommended)

```
composer require magepal/magento2-preview-checkout-success-page
```


##### Manual Installation
To install Checkout Previewer for Magento2
 * Download the extension
 * Unzip the file
 * Create a folder {Magento root}/app/code/MagePal/PreviewCheckoutSuccessPage
 * Copy the content from the unzip folder
 * Flush cache

#### Step 2 -  Enable Lazy Load for Magento2
 * php -f bin/magento module:enable --clear-static-content MagePal_PreviewCheckoutSuccessPage
 * php -f bin/magento setup:upgrade

#### Step 3 - Config Checkout Previewer for Magento2
Log into your Magento Admin, then goto Stores -> Configuration -> MagePal -> Checkout

Contribution
---
Want to contribute to this extension? The quickest way is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).


Support
---
If you encounter any problems or bugs, please open an issue on [GitHub](https://github.com/magepal/magento2-preview-checkout-success-page/issues).

Need help setting up or want to customize this extension to meet your business needs? Please email support@magepal.com and if we like your idea we will add this feature for free or at a discounted rate.

Other Extensions
---
[Custom SMTP](https://www.magepal.com/magento2/extensions/custom-smtp.html) | [Google Tag Manager](https://www.magepal.com/magento2/extensions/google-tag-manager.html) | [Enhanced E-commerce](https://www.magepal.com/magento2/extensions/enhanced-ecommerce-for-google-tag-manager.html) | [Google Universal Analytics](https://www.magepal.com/magento2/extensions/google-universal-analytics-enhanced-ecommerce.html) | [Reindex](https://www.magepal.com/magento2/extensions/reindex.html) | [Custom Shipping Method](https://www.magepal.com/magento2/extensions/custom-shipping-rates-for-magento-2.html) | [Preview Order Confirmation](https://www.magepal.com/magento2/extensions/preview-order-confirmation-page-for-magento-2.html) | [Guest to Customer](https://www.magepal.com/magento2/extensions/guest-to-customer.html) | [Admin Form Fields Manager](https://www.magepal.com/magento2/extensions/admin-form-fields-manager-for-magento-2.html) | [Customer Dashboard Links Manager](https://www.magepal.com/magento2/extensions/customer-dashboard-links-manager-for-magento-2.html) | [Lazy Loader](https://www.magepal.com/magento2/extensions/lazy-load.html) | [Order Confirmation Page Miscellaneous Scripts](https://www.magepal.com/magento2/extensions/order-confirmation-miscellaneous-scripts-for-magento-2.html)

© MagePal LLC. | [www.magepal.com](http:/www.magepal.com)
