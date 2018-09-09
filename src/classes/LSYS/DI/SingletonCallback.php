<?php
/**
 * 通过回调方式创建共享对象
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
class SingletonCallback implements Singleton{
    protected $_invoke;
    public function __construct(callable $invoke){
        $this->_invoke=$invoke;
    }
    public function __invoke(){
        return call_user_func_array($this->_invoke,func_get_args());
    }
}