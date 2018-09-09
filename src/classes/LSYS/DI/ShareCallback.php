<?php
/**
 * 通过回调方式创建共享对象
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
class ShareCallback implements Share{
    protected $_invoke;
    protected $_handle;
    public function __construct(callable $handle,callable $invoke){
        $this->_handle=$handle;
        $this->_invoke=$invoke;
    }
    public function handle(){
        return call_user_func_array($this->_handle,func_get_args());
    }
    public function __invoke(){
        return call_user_func_array($this->_invoke,func_get_args());
    }
}