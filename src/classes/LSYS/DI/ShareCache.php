<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
/**
 * 设置或清除共享的对象
 */
class ShareCache{
    protected $_invoke;
    protected $_args;
    /**
     * 通过制定回调函数和参数实现创建对象
     * @param callable $invoke
     * @param array $args
     */
    public function __construct(callable $invoke=null,array $args=array()){
        $this->_invoke=$invoke;
        $this->_args=$args;
    }
    /**
     * 创建对象参数
     * @return array
     */
    public function handleArgs():array{
        return $this->_args;
    }
    /**
     * 替换对象实现
     * @param mixed $object
     * @return mixed
     */
    public function replace($object){
        if(is_null($this->_invoke))return null;
        return call_user_func($this->_invoke,$object,$this->_args);
    }
}