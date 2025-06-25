# SprykerCommunity Test Module Integration Guide

This README provides step-by-step instructions to integrate the SprykerCommunity Test Module into your Spryker B2B Demo Shop.

### Prerequisites

1. Spryker B2B Demo Shop installed and running
2. Git access to clone the test module
3. Composer installed

### Installation Steps

1. Adjust .gitignore of demo-shop

Add the module directory to your main project's .gitignore file to prevent tracking the module as part of the main project:

```
# Add to .gitignore
/module/
```


2. Create Module Directory

Create a module directory in your demo shop root:

```bash
mkdir module
cd module
```


3. Clone Test Module

Clone the test module repository into the module directory:

```bash
git clone git@github.com:spryker-community/test-module.git test-module
```

Your directory structure should now look like:

```text
b2b-demo-shop/
├── module/
│   └── test-module/
│       └── src/
│           └── SprykerCommunity/
│               └── Zed/
│                   └── TestModule/
├── src/
├── vendor/
└── composer.json
```


4. Configure Spryker Core Namespaces

Add the SprykerCommunity namespace to your Spryker configuration:

File: `config/Shared/config_default.php`

```php
<?php

// Add SprykerCommunity to the core namespaces array
$config[KernelConstants::CORE_NAMESPACES] = [
    'SprykerCommunity',  // Add this line
    'SprykerShop',
    'SprykerEco',
    'Spryker',
    'SprykerSdk',
];
```

5. Update Main Project composer.json

Add the path repository configuration to your main project's composer.json:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "module/test-module",
            "options": {
                "symlink": true
            }
        }
    ],
}
```


6. Install the Module

Run the composer require command from your demo shop root directory:

```bash
composer require spryker-community/test-module:@dev
```

7. Clear Cache (Optional)

If needed, clear the Spryker cache:

```bash
vendor/bin/console cache:empty-all
```

### Verification

After successful installation, you should be able to access the test module at:
http://backoffice.eu.spryker.local/test-module
