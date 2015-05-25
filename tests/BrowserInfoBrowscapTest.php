<?php 

namespace asu\browserinfo;

class BrowserInfoBrowscapTest extends \PHPUnit_Framework_TestCase {

    public function testGetBrowserNameReturnNullWhenNoCacheIsAvailable() {
        $testee = new BrowserInfoBrowscap();
        $browserName = $testee->getBrowserName();
        $this->assertEquals(null, $browserName);
    }

}
