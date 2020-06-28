<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\DI;
/**
 * 通过回调方式创建共享对象
 */
class ShareCallback implements Share{
    protected $_invoke;
    protected $_handle;
    /**
     * 指定句柄为该对象识别字符串生成函数
     * @param callable $handle
     * @param callable $invoke
     */
    public function __construct(callable $handle,callable $invoke){
        $this->_handle=$handle;
        $this->_invoke=$invoke;
    }
    /**
     * {@inheritDoc}
     * @see \LSYS\DI\Share::handle()
     */
    public function handle():string{
        return call_user_func_array($this->_handle,func_get_args());
    }
    /**
     * {@inheritDoc}
     * @see \LSYS\DI\Share::__invoke()
     */
    public function __invoke(){
        return call_user_func_array($this->_invoke,func_get_args());
    }
}