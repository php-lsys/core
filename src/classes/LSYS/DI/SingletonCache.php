<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
/**
 * 设置或清除DI里的单例对象
 */
class SingletonCache{
    protected $_invoke;
    /**
     * 通过制定回调函数实现单例的替换
     * @param callable $invoke
     */
    public function __construct(callable $invoke=null){
        $this->_invoke=$invoke;
    }
    /**
     * 实现替换方法
     * @param mixed $object
     * @return mixed
     */
    public function replace($object){
        if(is_null($this->_invoke))return null;
        return call_user_func($this->_invoke,$object);
    }
}