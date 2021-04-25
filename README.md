# Mage2 Module MagEx Content Security Policy

    magex/content-security-policy


As of version 2.3.5, Magento supports CSP headers and provides ways to configure them.
(This functionality is defined in the Magento_Csp module.) Magento also provides default configurations at the application level and for individual core modules that require extra configuration.
Policies can be configured for adminhtml and storefront areas separately to accommodate different use cases. Magento also permits configuring unique CSPs for specific pages.


 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
 - This module allows Admin to add external sources to CSP header from Store configuration 

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/MagEx`
 - Enable the module by running `php bin/magento module:enable MagEx_ContentSecurityPolicy`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - public repository `packagist.org`
    - public github repository as vcs
 - Install the module composer by running `composer require magex/content-security-policy`
 - enable the module by running `php bin/magento module:enable MagEx_ContentSecurityPolicy`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

- global            `Global policy.`
- default-src       `The default policy.`
- base-uri      	`Defines which URLs can appear in a page’s <base> element.`
- child-src     	`Defines the sources for workers and embedded frame contents.`
- connect-src       `Defines the sources that can be loaded using script interfaces.`
- font-src      	`Defines which sources can serve fonts.`
- form-action       `Defines valid endpoints for submission from <form> tags.`
- frame-ancestors   `Defines the sources that can embed the current page.`
- frame-src     	`Defines the sources for elements such as <frame> and <iframe>.`
- img-src       	`Defines the sources from which images can be loaded.`
- manifest-src      `Defines the allowable contents of web app manifests.`
- media-src     	`Defines the sources from which images can be loaded.`
- object-src        `Defines the sources for the <object>, <embed>, and <applet> elements.`
- script-src        `Defines the sources for JavaScript <script> elements.`
- style-src     	`Defines the sources for stylesheets.`

## Specifications

 - Config reader
	- MagEx\ContentSecurityPolicy\Collector\Config\ScopeConfigPolicyReader


