<?php

namespace asu\browserinfo;

use Yii;
use yii\base\Component;
use phpbrowscap\Browscap;
use phpbrowscap\phpbrowscap;

/**
 * The browscap implementation for BrowserInfo.
 * 
 * @author Alex
 */
class BrowserInfoBrowscap extends Component implements BrowserInfo {

    /**
     * Memory limit to set while updating cache.
     * Browscap needs much for this process.
     *
     * @var string memory limit.
     */
    public $memoryLimit = null;

    /**
     * Directory name for the cache.
     * You can use Yii-Aliases. Default to @runtime/browscap.
     *
     * @var string cache directory.
     */
    public $cacheDir = '@runtime/browscap';

    /**
     * Name of the browscap cache file.
     * This is stored in the cache directory.
     *
     * @var string cache file name.
     */
    public $cacheFilename = 'cache.php';

    /**
     * Name of the browscap ini file.
     * This is stored in the cache directory.
     *
     * @var string ini file name.
     */
    public $iniFilename = 'browscap.ini';

    public function updateCache() {
        if ($this->memoryLimit != null) {
            ini_set('memory_limit', $this->memoryLimit);
        }
        $cacheDir = $this->getCacheDir();
        if (!file_exists($cacheDir)) {
            mkdir($cacheDir);
        }
        $bc = $this->createBrowscap();
        if (!$bc->updateCache()) {
            Yii::error('error while updating browscap cache');
        }
    }

    public function getBrowserName() {
        $browserName = null;
        $currentBrowser = $this->getCurrentBrowser();
        if ($currentBrowser != null) {
            $browserName = $currentBrowser->Browser;
        }
        return empty($browserName) ? null : $browserName;
    }

    public function isBot() {
        $currentBrowser = $this->getCurrentBrowser();
        if ($currentBrowser != null) {
            if (property_exists($currentBrowser, 'Browser_Type') && $currentBrowser->Browser_Type == 'Bot/Crawler') {
                return true;
            }
        }
        return false;
    }

    /**
     * Creates a browscap instance.
     *
     * @return \phpbrowscap\Browscap
     */
    private function createBrowscap() {
        $browscap = new Browscap($this->getCacheDir());
        $browscap->cacheFilename = $this->cacheFilename;
        $browscap->iniFilename = $this->iniFilename;
        // Working with the full browscap.ini (need for isBot information)
        $browscap->remoteIniUrl = 'http://browscap.org/stream?q=Full_PHP_BrowsCapINI';
        return $browscap;
    }

    private function getCurrentBrowser() {
        if ($this->existsCache()) {
            $bc = $this->createBrowscap();
            $bc->doAutoUpdate = false;
            return $bc->getBrowser();
        }
        return null;
    }

    private function existsCache() {
        return ($this->existsCacheDir() && $this->existsFiles());
    }

    private function existsCacheDir() {
        return file_exists($this->getCacheDir());
    }

    private function existsFiles() {
        $path = $this->getCacheDir();
        $pathIniFile = $path . DIRECTORY_SEPARATOR . $this->iniFilename;
        $pathCacheFile = $path . DIRECTORY_SEPARATOR . $this->cacheFilename;
        return file_exists($pathIniFile) && file_exists($pathCacheFile);
    }

    private function getCacheDir() {
        return Yii::getAlias($this->cacheDir);
    }

}
