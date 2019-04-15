<?php
/**
 * 设置或清除共享的对象
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
class ShareCache{
    protected $_invoke;
    protected $_args;
    public function __construct(callable $invoke=null,array $args=array()){
        $this->_invoke=$invoke;
        $this->_args=$args;
    }
    public function handleArgs(){
        return $this->_args;
    }
    public function replace($object){
        if(is_null($this->_invoke))return null;
        return call_user_func($this->_invoke,$object,$this->_args);
    }
}