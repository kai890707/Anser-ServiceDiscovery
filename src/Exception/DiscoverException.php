<?php

namespace SDPMlab\Anser\Exception;

use SDPMlab\Anser\Exception\AnserException;
use psr\Http\Message\ResponseInterface;

class DiscoverException extends AnserException
{
    /**
     * 初始化　SimpleServiceException
     *
     * @param string $message 錯誤訊息
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function NotHealthService($serviceName, $healthStatus): DiscoverException
    {
        return new self("服務名稱 : ".$serviceName." 目前非健康狀態，請確認服務是否可用，當前檢查狀態為 ".$healthStatus." 。");
    }

    public static function NotExistService($serviceName): DiscoverException
    {
        return new self("服務名稱 : ".$serviceName." 不存在，請於Consul Service確認服務狀態。");
    }

    public static function connectException(): DiscoverException
    {
        return new self("連線設定有誤，請確認DiscoverAdapter::setDiscoverConfig 方法設定是否正確。");
    }

    /**
     * 服務發現驅動有誤
     *
     * @param string $driver
     * @return DiscoverException
     */
    public static function discoverDriverNotFound(string $driver): DiscoverException
    {
        return new self("discoverDriver參數設定錯誤，如需設定服務發現服務，請設定discoverMode參數為 'Default' 或 'Fabio'。");
    }

    /**
     * 更新服務列表API請求錯誤
     *
     * @param string $serviceName
     * @param string $driverName
     * @return DiscoverException
     */
    public static function routeApiActionFail(string $serviceName,string $driverName,ResponseInterface $response): DiscoverException
    {
        return new self("Action {$serviceName} 於更新服務列表時發生 HTTP  {$response->getStatusCode()}  異常，導致服務列表更新失敗，請確認您的 {$driverName} 服務是否有誤。");
    }

    /**
     * 演算法設定錯誤
     *
     * @param string $lbStrategy
     * @return void
     */
    public static function lbStrategyNotFound(string $lbStrategy)
    {
        return new self("AnserDiscover 於建構時發生失敗，演算法設定有誤，設定為 {$lbStrategy} ，請確認是否有誤。");
    }
}
