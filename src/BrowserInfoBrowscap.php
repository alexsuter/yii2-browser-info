<?php
namespace asu\browserinfo;

use Yii;
use yii\base\Component;
use phpbrowscap\Browscap;

class BrowserInfoBrowscap extends Component implements BrowserInfo {
    
    public $memoryLimit = null;
    
    /**
     * Directory name for the cache.
     * 
     * @var string
     */
    public $cacheDir = 'browscap';
    
    /**
     * Where to store the cached PHP arrays.
     *
     * @var string
     */
    public $cacheFilename = 'cache.php';

    /**
     * Where to store the downloaded ini file.
     *
     * @var string
     */
    public $iniFilename = 'browscap.ini';

    public function getBrowserName() {
        $browserName = null;
        if ($this->existsCache()) {
            $bc = new Browscap($this->getCacheDir());
            $bc->doAutoUpdate = false;
            $current_browser = $bc->getBrowser();
            if ($current_browser != null) {
                $browserName = $current_browser->Browser;
            }
        }
        return empty($browserName) ? null : $browserName;
    }
    
    public function updateCache() {
        if ($this->memoryLimit != null) {
            ini_set('memory_limit', $this->memoryLimit);
        }
        $cacheDir = $this->getCacheDir();
        if (!file_exists($cacheDir)) {
            mkdir($cacheDir);
        }
        $bc = new Browscap($cacheDir);
        if (!$bc->updateCache()) {
            Yii::error('error while updating browscap cache');
        }
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
        return Yii::$app->runtimePath . DIRECTORY_SEPARATOR . $this->cacheDir;
    }
}

?>
