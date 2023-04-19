<?php

namespace App\Controllers;
use SDPMlab\Anser\Discovery\DiscoverFactory;
use SDPMlab\Anser\Service\ServiceList;
use \SDPMlab\Anser\Service\Action;
use SDPMlab\Anser\Exception\ActionException;
use \Psr\Http\Message\ResponseInterface;
use DCarbone\PHPConsulAPI\Consul;
use DCarbone\PHPConsulAPI\Config;
use Workerman\Lib\Timer;
use Workerman\Worker;
class Home extends BaseController
{
    public  $fabioRouteService = 'http://140.127.74.171:9998';   // http://fabioIP:9998
    public  $fabioProxyService = 'http://140.127.74.171:9999';   // http://fabioIP:9999
    public  $consulService = '140.127.74.171:8500';       // http://consulIP:8500

    public function index()
    {
        // // return view('welcome_message');


        // DiscoverFactory::initDiscoverDriver('Fabio',[
        //     'fabioRouteService' => $this->fabioRouteService,
        //     'fabioProxyService' => $this->fabioProxyService,
        //     'updateTimeout'     => ""
        // ]);
        ServiceList::addLocalService("CCC","127.0.0.1",8080,false);
        // DiscoverFactory::getDiscoverDriver()->startToUpdate();

        // DiscoverFactory::initDiscoverDriver('default',[
        //     'Address'    => $consulService,     // [required]
        //     'Scheme'     => 'http',                    // [optional] 對consul連線的Scheme ， defaults to "http"  [option: HTTP | HTTPS]
        //     // 'Datacenter' => 'name of datacenter',   // [optional]
        //     // 'HttpAuth' => 'user:pass',              // [optional]
        //     // 'WaitTime' => '0s',                     // [optional] amount of time to wait on certain blockable endpoints.  go time duration string format. 
        //     // 'Token' => 'auth token',                // [optional] default auth token to use
        //     // 'TokenFile' => 'file with auth token',  // [optional] file containing auth token string
        //     // 'InsecureSkipVerify' => false,          // [optional] if set to true, ignores all SSL validation
        //     // 'CAFile' => '',                         // [optional] path to ca cert file, see http://docs.guzzlephp.org/en/latest/request-options.html#verify
        //     // 'CertFile' => '',                       // [optional] path to client public key.  if set, requires KeyFile also be set
        //     // 'KeyFile' => '',                        // [optional] path to client private key.  if set, requires CertFile also be set
        //     // 'JSONEncodeOpts'=> 0,                   // [optional] php json encode opt value to use when serializing requests
        // ]);
        
        // $consul = new Consul(new Config([
        //         'HttpClient' => ServiceList::getHttpClient(),
        //         'Address'    => $this->consulService,     // [required]
        //         'Scheme'     => 'http',                    // [optional] 對consul連線的Scheme ， defaults to "http"  [option: HTTP | HTTPS]
        //         // 'Datacenter' => 'name of datacenter',   // [optional]
        //         // 'HttpAuth' => 'user:pass',              // [optional]
        //         // 'WaitTime' => '0s',                     // [optional] amount of time to wait on certain blockable endpoints.  go time duration string format. 
        //         // 'Token' => 'auth token',                // [optional] default auth token to use
        //         // 'TokenFile' => 'file with auth token',  // [optional] file containing auth token string
        //         // 'InsecureSkipVerify' => false,          // [optional] if set to true, ignores all SSL validation
        //         // 'CAFile' => '',                         // [optional] path to ca cert file, see http://docs.guzzlephp.org/en/latest/request-options.html#verify
        //         // 'CertFile' => '',                       // [optional] path to client public key.  if set, requires KeyFile also be set
        //         // 'KeyFile' => '',                        // [optional] path to client private key.  if set, requires CertFile also be set
        //         // 'JSONEncodeOpts'=> 0,                   // [optional] php json encode opt value to use when serializing requests

        //         'LbStrategy' => 'rr'                       // [optional] 提供 rr 與 rnd ，預設RR
        //     ]));
        // $nowService = $consul->Agent()->ChecksWithFilter('');


        // $nowService = $consul->Agent()->ChecksWithFilter('Status==passing');
        // $services = $nowService->Checks;
        // var_dump($services);
        // $neededService = [];
        // // var_dump($nowService->Checks);
        // // var_dump("---------------------------------------------");
        // foreach ($services as $service) {

        //     if(in_array("HTTP",$service->ServiceTags)){
        //         $neededService[] = $service->ServiceName;
        //     }
        // }
        // var_dump($consul->Catalog()->Services());
        // $v = $consul->Agent()->AgentHealthServiceByName("CI5");
        // var_dump($v);
        // array_unique($neededService);
        // var_dump($neededService);
        // $a = $consul->Agent()->AgentHealthServiceByName("CI5")->getAgentServiceChecksInfos();
        // count($a);
        // foreach ($a as $service) {
        //     var_dump($service->getService()->getService());
        //     var_dump($service->getService()->getAddress());
        //     var_dump($service->getService()->getPort());
        // }
        // $consul->Agent()->ServiceDeregister("CI5-2");

        // var_dump();
        // $a = $consul->Agent()->ChecksWithFilter('Status==passing');
        // var_dump($a->Checks);
        // var_dump($a->Checks === $nowService->Checks);
        // $a = $consul->Agent()->AgentHealthServiceByName("CI5");
        // var_dump($a);
        // $service = $consul->Catalog()->Service("FakeRest","HTTPS");
        // var_dump($nowService->Checks);
        // var_dump("2-*-------------");
        // var_dump(DiscoverFactory::getDiscoverDriver()->updateDiscoverServicesList());
        // DiscoverFactory::getDiscoverDriver()->updateDiscoverServicesList();
        // var_dump(ServiceList::getServiceList());
        // // ServiceList::addLocalService("P","127.0.0.1",80,false);
        // // ServiceList::getServiceList();


        // step 1 => 取得服務節點名稱 (重複的節點名稱只會顯示一個)
        // $serviceNameList = [];
        // $allService = $consul->Catalog()->Services()->getValue();

        // foreach ($allService as $serviceNode => $serviceTagArr) {
        //     $lowerCaseTags = array_map('strtolower', $serviceTagArr);
        //     // 取得服務對應的所有Tag
        //     if(in_array("anser",$lowerCaseTags)){
        //         $serviceNameList[] = $serviceNode;
        //     }
        // }

        // $serviceOfNode = [];
        
        // if (count($serviceNameList) > 0) {

        //     foreach ($serviceNameList as $serviceName) {
        //         // step 2 => 使用這些服務節點進一步取得健康的服務
        //         $healthServicesNode = $consul->Agent()->AgentHealthServiceByName($serviceName)->getAgentServiceChecksInfos();
                
        //         foreach ($healthServicesNode as $serviceNode) {
                
        //             $lowerCaseTags = array_map('strtolower', $serviceNode->getService()->getTags());
        //             // step 3 => 取得健康服務後解析TAG是否包含Anser，如果有就+入服務列表，並看Tag中是否有HTTP有的話就紀錄
        //             if($serviceNode->getAggregatedStatus() == "passing" && in_array("anser",$lowerCaseTags)){

        //                 $serviceOfNode[$serviceNode->getService()->getService()][] = [
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
        
        // loadBalance
        // var_dump($serviceOfNode);
        // foreach ($serviceOfNode as $serviceName => $node) {
            
        //     if (count($node) > 1){

        //         // 計算當前的伺服器索引
        //         if (!isset($_SESSION[$serviceName]['server_index'])) {
        //             $_SESSION[$serviceName]['server_index'] = 0;
        //         } else {
        //             $_SESSION[$serviceName]['server_index'] = ($_SESSION[$serviceName]['server_index'] + 1) % count($node);
        //         }
        //         $server_index = $_SESSION[$serviceName]['server_index'];

        //         ServiceList::addLocalService($node[$server_index]["name"],
        //             $node[$server_index]["address"],
        //             $node[$server_index]["port"],
        //             $node[$server_index]["isHttp"],
        //         );

        //     }else{
        //         $_SESSION[$serviceName]['server_index'] = 0;
        //         ServiceList::addLocalService($node[0]["name"],
        //             $node[0]["address"],
        //             $node[0]["port"],
        //             $node[0]["isHttp"],
        //         );
        //     }
        // }
        // var_dump($_SESSION);
        // var_dump(ServiceList::getServiceList());
            
    }

    public function fabio()
    {
        // DiscoverFactory::initDiscoverDriver('Fabio',[
        //     'fabioRouteService' => $this->fabioRouteService,
        //     'fabioProxyService' => $this->fabioProxyService,
        //     'updateTimeout'     => ""
        // ]);

        // var_dump(DiscoverFactory::getDiscoverDriver()->getDiscoverServiceList());
        // $worker = new Worker('http://0.0.0.0:1234');
        var_dump(ServiceList::getServiceList());
        // return "123";
        
    }

    public static function roundRobin(string $serviceName ,array $serviceNode)
    {
        $serverIndex = 0 ;

        if (count($serviceNode) > 1) {

            if (!isset($_SESSION[$serviceName]['serverIndex'])) {
                    $_SESSION[$serviceName]['serverIndex'] = 0;
                } else {
                    $_SESSION[$serviceName]['serverIndex'] = ($_SESSION[$serviceName]['serverIndex'] + 1) % count($serviceNode);
                }
                $serverIndex = $_SESSION[$serviceName]['serverIndex'];

        }else{
            $_SESSION[$serviceName]['serverIndex'] = 0;
        }

        return $serviceNode[$serverIndex];
    }
}
