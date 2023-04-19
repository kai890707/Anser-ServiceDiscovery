<?php 
namespace App\Anser\Services;
// namespace SDPMlab\Anser\Discovery\AnserDiscover;
// require_once __DIR__.'../../../../develop/vendor/autoload.php';
// require_once '../../vendor/autoload.php';
use Workerman\Worker;
use SDPMlab\Anser\Discovery\DiscoverFactory;


$fabioRouteService = 'http://140.127.74.171:9998';   // http://fabioIP:9998
$fabioProxyService = 'http://140.127.74.171:9999';   // http://fabioIP:9999

// $worker = new Worker('http://0.0.0.0:1234');

// $worker->count = 1;


// $worker->onWorkerStart = function($worker) use ($fabioRouteService,$fabioProxyService){
//     // $time = 5;
    DiscoverFactory::initDiscoverDriver('Fabio',[
        'fabioRouteService' => $fabioRouteService,
        'fabioProxyService' => $fabioProxyService,
        'updateTimeout'     => ""
    ]);
    
//     // \Workerman\Lib\Timer::add($time,function(){
        DiscoverFactory::getDiscoverDriver()->updateDiscoverServicesList();
//         echo "123";
//     // });
// };

// Worker::runAll();


?>