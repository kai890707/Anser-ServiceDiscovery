<?php

namespace SDPMlab\Anser\Discovery\AnserDiscover;

use SDPMlab\Anser\Discovery\BaseDiscover;
use SDPMlab\Anser\Service\ServiceList;
use DCarbone\PHPConsulAPI\Consul;
use DCarbone\PHPConsulAPI\Config;
use SDPMlab\Anser\Exception\DiscoverException;
use SDPMlab\Anser\Discovery\AnserDiscover\Algorithms;
class AnserDiscover extends BaseDiscover
{
    /**
     * consul 設定
     *
     * @var array<string,string>
     */
    protected static array $config = [
        'Address'    => '127.0.0.1:8500',            // [required]
        'Scheme'     => 'http',                    // [optional] 對consul連線的Scheme ， defaults to "http"  [option: HTTP | HTTPS]
        // 'Datacenter' => 'name of datacenter',   // [optional]
        // 'HttpAuth' => 'user:pass',              // [optional]
        // 'WaitTime' => '0s',                     // [optional] amount of time to wait on certain blockable endpoints.  go time duration string format. 
        // 'Token' => 'auth token',                // [optional] default auth token to use
        // 'TokenFile' => 'file with auth token',  // [optional] file containing auth token string
        // 'InsecureSkipVerify' => false,          // [optional] if set to true, ignores all SSL validation
        // 'CAFile' => '',                         // [optional] path to ca cert file, see http://docs.guzzlephp.org/en/latest/request-options.html#verify
        // 'CertFile' => '',                       // [optional] path to client public key.  if set, requires KeyFile also be set
        // 'KeyFile' => '',                        // [optional] path to client private key.  if set, requires CertFile also be set
        // 'JSONEncodeOpts'=> 0,                   // [optional] php json encode opt value to use when serializing requests  
    ];

    /**
     * consul client 實體
     *
     * @var Consul
     */
    public static $consulClient;

    /**
     * 服務發現列表
     *
     * @var array
     */
    public static $discoveryList = [];

    public function __construct(array $config)
    {

        parent::__construct();

        static::$config = $config;

        static::$config['HttpClient'] = static::$client;

        static::$consulClient = new Consul(new Config(static::$config));

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
        
        // $serviceNameList = [];
        // $allService = static::$consulClient->Catalog()->Services()->getValue();
        
        // foreach ($allService as $serviceNode => $serviceTagArr) {
        //     if(in_array("Anser",$serviceTagArr)){
        //         $serviceNameList[] = $serviceNode;
        //     }
        // }
        
        // if (count($serviceNameList) > 0) {

        //     foreach ($serviceNameList as $serviceName) {
        //         // step 2 => 使用這些服務節點進一步取得健康的服務
        //         $healthServicesNode = static::$consulClient->Agent()->AgentHealthServiceByName($serviceName)->getAgentServiceChecksInfos();
                
        //         foreach ($healthServicesNode as $serviceNode) {
                
        //             $lowerCaseTags = array_map('strtolower', $serviceNode->getService()->getTags());

        //             if($serviceNode->getAggregatedStatus() == "passing" && in_array("anser",$lowerCaseTags)){

        //                 static::$discoveryList[$serviceNode->getService()->getService()][] = [
        //                     "id"      => $serviceNode->getService()->getID(),
        //                     "name"    => $serviceNode->getService()->getService(),
        //                     "address" => $serviceNode->getService()->getAddress(),
        //                     "port"    => $serviceNode->getService()->getPort(),
        //                     "isHttp"  => in_array("https",$lowerCaseTags) ? true : false,
        //                 ];
        //             }
        //         }
        //     }
        // }
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

    public function checkIsUpdate($serviceNode)
    {
        if ($serviceNode == static::$discoveryList[$serviceNode->getService()->getService()]) {
            
        }
    }
}
