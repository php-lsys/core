<?php
/**
 * 通过回调方式创建对象
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
class VirtualCallback implements SetMethod{
    protected $_class;
    public function __construct($class=null){
        $this->_class=$class;
    }
    public function __toString(){
        return strval($this->_class);
    }
}