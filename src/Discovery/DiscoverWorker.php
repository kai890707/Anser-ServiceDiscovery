<?php
namespace SDPMlab\Anser\Discovery;

use Workerman\Worker;

$fabioRouteService = 'http://140.127.74.171:9998';   // http://fabioIP:9998
$fabioProxyService = 'http://140.127.74.171:9999';   // http://fabioIP:9999

$worker = new Worker('http://0.0.0.0:1234');

$worker->count = 1;


$worker->onWorkerStart = function($worker) use ($fabioRouteService,$fabioProxyService){
    $time = 5;
DiscoverFactory::initDiscoverDriver('Fabio',[
    'fabioRouteService' => $fabioRouteService,
    'fabioProxyService' => $fabioProxyService,
    'updateTimeout'     => ""
]);

//     // \Workerman\Lib\Timer::add($time,function(){
    DiscoverFactory::getDiscoverDriver()->updateDiscoverServicesList();
//         echo "123";
    // });
};

Worker::runAll();
// class DiscoverWorker extends Worker{

//     public function __construct($protocol, $addr)
//     {
//         parent::__construct($protocol . '://' . $addr);
//         $this->onMessage = array($this, 'onMessage');
//     }

//     public function onWorkerStart($worker)
//     {
        
//     }

//     public function onMessage($connection, $data)
//     {
//         // 在這裡處理接收到的資料
//         $connection->send('Hello ' . $data);
//     }
// }

?>