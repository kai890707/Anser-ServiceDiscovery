<?php

namespace SDPMlab\Anser\Discovery;

use SDPMlab\Anser\Discovery\DiscoverInterface;
use SDPMlab\Anser\Service\ServiceList;

abstract class BaseDiscover implements DiscoverInterface
{
    /**
     * GuzzleHttp 實體
     *
     * @var Client
     */
    protected static \GuzzleHttp\Client $client;

    public function __construct()
    {
        static::$client = ServiceList::getHttpClient();
    }
}
