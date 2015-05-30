<?php 

namespace asu\browserinfo;

class BrowserInfoBrowscapTest extends \PHPUnit_Framework_TestCase {

    public function testGetBrowserNameReturnNullWhenNoCacheIsAvailable() {
        $testee = new BrowserInfoBrowscap();
        $browserName = $testee->getBrowserName();
        $this->assertEquals(null, $browserName);
    }
    
    public function testGetBrowserNameReturnOperaWhenUserAgentIsOpera() {
        $_SERVER['HTTP_USER_AGENT'] = 'Opera/9.63 (Macintosh; Intel Mac OS X; U; en) Presto/2.1.1';
        $testee = new BrowserInfoBrowscap(['cacheDir' => __DIR__ . '/fixtures/browscap']);
        $browserName = $testee->getBrowserName();
        $this->assertEquals('Opera', $browserName);
    }
    
    public function testIsBotReturnFalseWhenNoCacheIsAvailable() {
        $testee = new BrowserInfoBrowscap();
        $isBot = $testee->isBot();
        $this->assertFalse($isBot);
    }
    
    public function testIsBotReturnTrueWhenUserAgentIsGoogleBot() {
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';
        $testee = new BrowserInfoBrowscap(['cacheDir' => __DIR__ . '/fixtures/browscap']);
        $this->assertTrue($testee->isBot());
    }
    
    public function testIsBotReturnFalseWhenUserAgentIsOperaBrowser() {
        $_SERVER['HTTP_USER_AGENT'] = 'Opera/9.63 (Macintosh; Intel Mac OS X; U; en) Presto/2.1.1';
        $testee = new BrowserInfoBrowscap(['cacheDir' => __DIR__ . '/fixtures/browscap']);
        $this->assertFalse($testee->isBot());
    }

}
