yii2-browser-info
=================

[![Latest Stable Version](https://poser.pugx.org/alexander-suter/yii2-browser-info/v/stable)](https://packagist.org/packages/alexander-suter/yii2-browser-info)
[![Total Downloads](https://poser.pugx.org/alexander-suter/yii2-browser-info/downloads)](https://packagist.org/packages/alexander-suter/yii2-browser-info)
[![Build Status](https://secure.travis-ci.org/alexander-suter/yii2-browser-info.png)](http://travis-ci.org/alexander-suter/yii2-browser-info)
[![Dependency Status](https://www.versioneye.com/php/alexander-suter:yii2-browser-info/dev-master/badge.png)](https://www.versioneye.com/php/alexander-suter:yii2-browser-info/dev-master)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/alexander-suter/yii2-browser-info/badges/quality-score.png?s=b1074a1ff6d0b214d54fa5ab7abbb90fc092471d)](https://scrutinizer-ci.com/g/alexander-suter/yii2-browser-info/)

Yii2 extension. Provides detailed information about the browser.

Current available providers:
- Browscap (https://github.com/browscap/browscap)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install, either run

```
$ php composer.phar require alexander-suter/yii2-browser-info "*"
```

or add

```
"alexander-suter/yii2-browser-info": "*"
```

to the ```require``` section of your `composer.json` file.

## Usage

This extensions works with a cache in the background. You have to update the cache from time to time.

Create a cronjob and execute following command:

```
./yii browser-info/update-cache
```

Use dependency injection to define the concret instance:

```
Yii::$container->set('asu\browserinfo\BrowserInfo', [
            'class' => 'asu\browserinfo\BrowserInfoBrowscap',
            'memoryLimit' => '512M' 
]);
```
The Browscap implementation needs much memory to update the cache.

To get browser information in a controller you can now use your DI-Definition:

```
class SiteController extends Controller {
      private $browserInfo = null;
      public function __construct($id, $module, BrowserInfo $browserInfo, $config = []) {
        $this->browserInfo = $browserInfo;
        parent::__construct($id, $module, $config);
      }
      public function actionIndex() {
        echo $this->browserInfo->getBrowserName();
      }
}
```
