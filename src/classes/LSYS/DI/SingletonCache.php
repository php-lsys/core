<?php
/**
 * 设置或清除DI里的单例对象
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
class SingletonCache{
    protected $_invoke;
    public function __construct(callable $invoke=null){
        $this->_invoke=$invoke;
    }
    public function replace($object){
        if(is_null($this->_invoke))return null;
        return call_user_func($this->_invoke,$object);
    }
}