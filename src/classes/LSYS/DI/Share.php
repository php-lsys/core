<?php
/**
 * 共享对象接口
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
interface Share extends SetMethod{
    /**
     * 得到指定对象的识别句柄字符串
     */
    public function handle();
    /**
     * 生成共享对象
     */
    public function __invoke();
}