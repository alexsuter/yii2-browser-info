<?php

namespace asu\browserinfo;

use yii\console\Controller;

/**
 * Browser info cache controller.
 */
class BrowserInfoController extends Controller {

    private $browserInfo = null;
    
    public function __construct($id, $module, BrowserInfo $browserInfo, $config = []) {
        $this->browserInfo = $browserInfo;
        parent::__construct($id, $module, $config);
    }

    public function actionUpdateCache() {
        $this->browserInfo->updateCache();
    }

}

?>