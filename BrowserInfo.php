<?php

namespace asu\browserinfo;

interface BrowserInfo {

    /**
     * Returns the name of the browser of the current request.
     * If the cache is empty the return value is null.
     *
     * @return string browser name
     */
    public function getBrowserName();

    /**
     * Updates the browser name directory cache.
     */
    public function updateCache();

}

?>