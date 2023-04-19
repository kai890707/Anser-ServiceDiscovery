<?php 

// namespace SDPMlab\Anser\Discovery\AnserDiscover;
// require_once __DIR__.'../../../../develop/vendor/autoload.php';
// require_once __DIR__.'/../develop/vendor/autoload.php';
// include('./src/Discovery/DiscoverFactory.php');
use \SDPMlab\Anser\Discovery\DiscoverFactory;

use Workerman\Worker;
use Workerman\Lib\Timer;
use SDPMlab\Anser\Service\ServiceList;
use DCarbone\PHPConsulAPI\Consul;
use DCarbone\PHPConsulAPI\Config;

include 'vendor/autoload.php';


$consulService     = 'http://140.127.74.171:8500';   // http://consulIP:8500


$fabioRouteService = 'http://140.127.74.171:9998';   // http://fabioIP:9998
$fabioProxyService = 'http://140.127.74.171:9999';   // http://fabioIP:9999

$worker = new Worker();

$worker->count = 1;


$worker->onWorkerStart = function($worker) use ($fabioRouteService,$fabioProxyService){
    $time = 5;

    DiscoverFactory::initDiscoverDriver('Fabio',[
        'fabioRouteService' => $fabioRouteService,
        'fabioProxyService' => $fabioProxyService,
        'updateTimeout'     => ""
    ]);

    Timer::add($time,function(){
        DiscoverFactory::getDiscoverDriver()->updateDiscoverServicesList();
    });
};

Worker::runAll();

?>