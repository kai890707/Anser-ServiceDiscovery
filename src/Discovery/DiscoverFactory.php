<?php

namespace SDPMlab\Anser\Discovery;

use GuzzleHttp\Client;
use SDPMlab\Anser\Discovery\DiscoverInterface;
use SDPMlab\Anser\Exception\DiscoverException;
use SDPMlab\Anser\Discovery\AnserDiscover\AnserDiscover;
use SDPMlab\Anser\Discovery\FabioDiscover\FabioDiscover;

class DiscoverFactory
{
    /**
     * 服務發現驅動映射實體列表
     *
     * @var array
     */
    private static $discoverMapping = [
        "Default" => AnserDiscover::class,
        "Fabio"   => FabioDiscover::class

    ];

    /**
     * 服務探索驅動
     *
     * @var DiscoverInterface
     */
    protected static $discoverDriver;

    /**
     * 設定服務發現實體
     *
     * @param string $driver
     * @param array $config
     * @return DiscoverInterface
     */
    public static function initDiscoverDriver(string $driver, array $config): DiscoverInterface
    {
        $driverName = ucfirst(strtolower($driver));

        if(isset(self::$discoverDriver)){
            return self::$discoverDriver;
        }

        if (isset(self::$discoverMapping[$driverName])) {
            self::$discoverDriver = new self::$discoverMapping[$driverName]($config);
            return self::$discoverDriver;
        } else {
            throw DiscoverException::discoverDriverNotFound($driver);
        }
    }

    /**
     * 回傳服務發現驅動實體
     *
     * @return DiscoverInterface
     */
    public static function getDiscoverDriver(): DiscoverInterface
    {
        return self::$discoverDriver;
    }

}
