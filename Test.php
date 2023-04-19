<?php
include 'vendor/autoload.php';
// use Workerman\Worker;
// use Workerman\Connection\AsyncTcpConnection;

// // 创建反向代理服务
// $proxy_worker = new Worker("tcp://0.0.0.0:8081");

// // 设置反向代理服务的进程数
// $proxy_worker->count = 4;

// // 当有客户端连接时
// $proxy_worker->onConnect = function ($connection) {
//     // 连接目标服务器
//     $remote_connection = new AsyncTcpConnection("tcp://localhost:8080/fabio");
//     // 将客户端请求转发到目标服务器
//     $connection->pipe($remote_connection);
//     $remote_connection->pipe($connection);
//     // 开始连接目标服务器
//     $remote_connection->connect();
// };

// // 运行反向代理服务
// Worker::runAll();


use \Workerman\Worker;
use \Workerman\Connection\AsyncTcpConnection;

// Autoload.
// require_once __DIR__ . '/vendor/autoload.php';

// Create a TCP worker.
$worker = new Worker('tcp://0.0.0.0:8081');
// 6 processes
$worker->count = 6;
// Worker name.
$worker->name = 'php-http-proxy';

// Emitted when data received from client.
$worker->onMessage = function($connection, $buffer)
{
    // Parse http header.
    list($method, $addr, $http_version) = explode(' ', $buffer);
    $url_data = parse_url($addr);
    $addr = !isset($url_data['port']) ? "{$url_data['host']}:80" : "{$url_data['host']}:{$url_data['port']}";
    // Async TCP connection.
    $remote_connection = new AsyncTcpConnection("tcp://$addr");
    // CONNECT.
    if ($method !== 'CONNECT') {
        $remote_connection->send($buffer);
    // POST GET PUT DELETE etc.
    } else {
        $connection->send("HTTP/1.1 200 Connection Established\r\n\r\n");
    }
    // Pipe.
    $remote_connection ->pipe($connection);
    $connection->pipe($remote_connection);
    $remote_connection->connect();
};

// Run.
Worker::runAll();
?>