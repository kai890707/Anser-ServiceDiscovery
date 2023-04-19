<?php

namespace SDPMlab\Anser\Discovery\FabioDiscover;

use SDPMlab\Anser\Discovery\BaseDiscover;
use SDPMlab\Anser\Service\ServiceList;
use Workerman\Worker;
use Workerman\Lib\Timer;

class FabioDiscover extends BaseDiscover
{
    /**
     * fabio 設定
     *
     * @var array<string,string>
     */
    protected static array $config = [
        'fabioRouteService' => '',
        'fabioProxyService' => '',
        'updateTimeout'     => 2
    ];

    /**
     * 服務發現列表
     *
     * @var array
     */
    public static $discoveryList = [];

    /**
     * 比對Fabio回傳服務列表，決定是否進行本地列表更新
     *
     * @var string
     */
    public static $prototypeServices;

    public static $worker;

    public function __construct(array $config)
    {

        parent::__construct();

        static::$config['fabioRouteService'] = $config['fabioRouteService'];
        static::$config['fabioProxyService'] = $config['fabioProxyService'];
        static::$config['updateTimeout']     = empty($config['updateTimeout']) == true ? 2 : (int)$config['updateTimeout'] ;
    }

    /**
     * 取得服務列表
     *
     * @return array
     */
    public function getDiscoverServiceList(): array
    {
        return static::$discoveryList;
    }

    /**
     * 取得某個服務節點
     *
     * @param string $serviceName
     * @return object
     */
    public function getDiscoverServiceNode(string $serviceName): array
    {

        $serviceNode = array_filter(static::$discoveryList, function ($item) use ($serviceName) {
            return array_key_exists("name", $item) && $item["name"] == $serviceName;
        });

        return $serviceNode;
    }

    /**
     * 更新服務發現列表
     *
     * @return void
     */
    public function updateDiscoverServicesList(): void
    {
    
        try {
            $response = static::$client->request('GET', static::$config["fabioRouteService"].'/api/routes', [ 'timeout' => (int)static::$config["updateTimeout"] ]);
        } catch(\GuzzleHttp\Exception\TransferException $e) {
            throw $e;
        }

        $services = json_decode($response->getBody()->getContents());

        if ($services != static::$prototypeServices) {

            static::$prototypeServices = $services;

            static::clearDiscoverServicesList();

            $serviceIndex = [];

            foreach ($services as $service) {

                if(!array_key_exists($service->service, $serviceIndex)) {
                    
                    $serviceIndex[] = $service->service;

                    static::$discoveryList[] = [
                        'name'    => $service->service,
                        'address' => parse_url(static::$config["fabioProxyService"], PHP_URL_HOST),
                        'port'    => parse_url(static::$config["fabioProxyService"], PHP_URL_PORT),
                        'isHttps' => parse_url(static::$config["fabioProxyService"], PHP_URL_SCHEME) == 'https' ? true : false,
                    ];
                }
            }

            ServiceList::cleanServiceList();
            ServiceList::setLocalServices(static::$discoveryList);
        }
    }

    /**
     * 清空本地服務發現列表
     *
     * @return void
     */
    public function clearDiscoverServicesList(): void
    {
        static::$discoveryList = [];
    }
}