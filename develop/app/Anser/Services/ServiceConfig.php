<?php
namespace App\Anser\Services;

use SDPMlab\Anser\Discovery\DiscoverFactory;
use SDPMlab\Anser\Service\ServiceList;
use Workerman\Worker;
// require_once './vendor/autoload.php';
$fabioRouteService = 'http://140.127.74.171:9998';   // http://fabioIP:9998
$fabioProxyService = 'http://140.127.74.171:9999';   // http://fabioIP:9999
// $consulService = 'http://140.127.74.171:8500';       // http://consulIP:8500

// DiscoverFactory::initDiscoverDriver('Fabio',[
//     'fabioRouteService' => $fabioRouteService,
//     'fabioProxyService' => $fabioProxyService,
//     'updateTimeout'     => ''
// ]);

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
// ],[
//     'AnserProxyService' => ''
// ]);

$driver = DiscoverFactory::initDiscoverDriver('Fabio',[
    'fabioRouteService' => $fabioRouteService,
    'fabioProxyService' => $fabioProxyService,
    'updateTimeout'     => ""
]);

$driver->updateDiscoverServicesList();

?>