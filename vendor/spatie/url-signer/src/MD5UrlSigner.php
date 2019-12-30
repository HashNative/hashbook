<?php

namespace Spatie\UrlSigner;

use League\Url\UrlImmutable;

class MD5UrlSigner extends BaseUrlSigner
{
    /**
     * Generate a token to identify the secure action.
     *
     * @param UrlImmutable|string $url
     * @param string                          $expiration
     *
     * @return string
     */
    protected function createSignature($url, $expiration)
    {
        $url = (string) $url;

        return md5("{$url}::{$expiration}::{$this->signatureKey}");
    }
}
