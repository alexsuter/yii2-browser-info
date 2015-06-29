# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [2.0.2] - 2015-06-29
### Changed
- Updated browscap/browscap-php from dev-master to 2.0.5. Stable Release.
- Definied dev dependencies like phpunit/phpunit and pahanini/yii2-consolelog.
- Optimized browscap-php behavior. Browscap updates the cache if your cache file and browscap implementation
not corresponding. But we never update cache for just getting browser information, because that needs much memory and time.
You will get null and a warning log which will inform you, that you have to update your browscap cache.

## [2.0.1] - 2015-06-22
### Changed
- Updated browscap/browscap-php from ~2.0 to dev-master. New version needs less memory for updating the cache than the older version. 

## [2.0.0] - 2015-05-30
### Changed
- The cacheDir in BrowserInfoBrowscap is now not only the name of the directory in the Yii-Runtime Folder. It is now the root folder for the cache. You can use Yii-Aliases.
