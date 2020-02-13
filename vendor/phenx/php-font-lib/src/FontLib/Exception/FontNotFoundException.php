<?php

namespace FontLib\Exception;

use Exception;

class FontNotFoundException extends Exception
{
    public function __construct($fontPath)
    {
        $this->message = 'Font not found in: ' . $fontPath;
    }
}