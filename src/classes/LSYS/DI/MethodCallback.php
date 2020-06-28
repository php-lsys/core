<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
/**
 * 通过回调方式创建对象
 */
class MethodCallback implements Method{
    protected $_invoke;
    /**
     * 传入创建对象回调函数
     * @param callable $invoke
     */
    public function __construct(callable $invoke){
        $this->_invoke=$invoke;
    }
    /**
     * {@inheritDoc}
     * @see \LSYS\DI\Method::__invoke()
     */
    public function __invoke(){
        return call_user_func_array($this->_invoke,func_get_args());
    }
}