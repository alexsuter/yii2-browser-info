<?php

namespace asu\browserinfo;

class BrowserInfoControllerTest extends \PHPUnit_Framework_TestCase {

    public function testUpdateCache() {
        $mock = $this->getMockBuilder(BrowserInfoBrowscap::className())->getMock();
        $mock->expects($this->once())->method('updateCache');
        $testee = new BrowserInfoController(1000, null, $mock);
        $testee->actionUpdateCache();
    }

}
