<?php

namespace PhpParser\ErrorHandler;

use PhpParser\Error;
use PHPUnit_Framework_TestCase;

class ThrowingTest extends PHPUnit_Framework_TestCase {
    /**
     * @expectedException Error
     * @expectedExceptionMessage Test
     */
    public function testHandleError() {
        $errorHandler = new Throwing();
        $errorHandler->handleError(new Error('Test'));
    }
}