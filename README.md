## Preview Checkout Success Page for Magento 2

[![Total Downloads](https://poser.pugx.org/magepal/magento2-preview-checkout-success-page/downloads)](https://packagist.org/packages/magepal/magento2-preview-checkout-success-page)
[![Latest Stable Version](https://poser.pugx.org/magepal/magento2-preview-checkout-success-page/v/stable)](https://packagist.org/packages/magepal/magento2-preview-checkout-success-page)

This extension allows you to quickly and easily preview and test your magento2 order confirmation page, without placing a new order each time.

![How to test or style the order success page](https://user-images.githubusercontent.com/1415141/32975104-f3a99442-cbd1-11e7-9aad-2914395a07e0.gif)


### Features
- Configure any order number you want to preview from admin.
- Quick and easily view checkout page source, inline with in admin or within a new browser window.
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

© MagePal LLC.
