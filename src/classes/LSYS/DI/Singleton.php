<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
/**
 * 工厂模式对象生成接口
 */
interface Singleton extends SetMethod{
    /**
     * 生成单例对象
     */
    public function __invoke();
}