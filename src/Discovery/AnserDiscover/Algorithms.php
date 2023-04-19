<?php 
namespace SDPMlab\Anser\Discovery\AnserDiscover;

class Algorithms {

    public static $methodMapping = [
        "rr"  => "roundRobin",   //Round Robin
        "rnd" => "random"
    ];

    /**
     * 輪詢演算法
     *
     * @param string $serviceName
     * @param array $serviceNode
     * @return void
     */
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

    /**
     * 隨機負載演算法
     *
     * @param array $serviceNode
     * @return void
     */
    public function random(array $serviceNode)
    {
        return $serviceNode[array_rand($serviceNode)];
    }


}

?>