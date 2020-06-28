<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
/**
 * 虚拟对象限定
 */
class VirtualCallback implements SetMethod{
    protected $_class;
    /**
     * 指定限定的类名限制实现对象
     * @param string $class
     */
    public function __construct(?string $class=null){
        $this->_class=$class;
    }
    /**
     * 返回限定类型类名
     * @return string
     */
    public function __toString():string{
        return strval($this->_class);
    }
}