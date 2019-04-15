<?php
/**
 * 依赖管理器
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS;
use LSYS\DI\SetMethod;
use LSYS\DI\Method;
use LSYS\DI\Share;
use LSYS\DI\Singleton;
use LSYS\DI\VirtualCallback;
use LSYS\DI\ShareCache;
use LSYS\DI\SingletonCache;
class DI{
    /**
     * @var array
     */
    private static $_di_cache=[];
    /**
     * 得到当前类或默认的依赖管理实例
     * @return static
     */
    public static function get(){
        $class=get_called_class();
        if (!isset(self::$_di_cache[$class]))$class=__CLASS__;
        if (!isset(self::$_di_cache[$class])){
            self::$_di_cache[$class]=new self;
        }
        $obj=self::$_di_cache[$class];
        if(is_callable($obj)){
            $obj=call_user_func($obj);
            assert($obj instanceof self,'Argument 1 passed to set() must be an instance of '.$class);
            self::$_di_cache[$class]=$obj;
        }
        return $obj;
    }
    /**
     * 检测当前类的依赖管理器示例是否设置
     * @return bool
     */
    public static function has(){
        return isset(self::$_di_cache[get_called_class()]);
    }
    /**
     * 设置当前类的依赖管理器实例
     * @param DI $di
     */
    public static function set($di){
        $class=get_called_class();
        (!is_callable($di))&&assert($di instanceof $class,'Argument 1 passed to set() must be an instance of '.$class);
        self::$_di_cache[$class]=$di;
        return __CLASS__;
    }
    /**
     * @var array
     */
    private $_virtual=[];
    /**
     * @var array
     */
    private $_set=[];
    /**
     * @var array
     */
    private $_cache=[];
    /**
     * @var array
     */
    private $_cache_share=[];
    /**
     * 检测某个方法是否已经注册
     * @param string $method
     * @return bool
     */
    public function __isset($method){
        return isset($this->_set[$method]);
    }
    /**
     * 移除指定方法注册并移除已注册的实例
     * 即移除已存在的单例或共享对象
     * @param string $method
     */
    public function __unset($method){
        if (!isset($this->_set[$method]))return;
        unset($this->_set[$method]);
        $call=$this->_set[$method];
        if ($call instanceof Singleton){
            unset($this->_cache[$method]);
        }
        if($call instanceof Share){
            unset($this->_cache_share[$method]);
        }
    }
    /**
     * 注册或调用某个方法
     * @param string|SetMethod $method
     * @param array $param [Set object]
     * @throws Exception
     * @return static|mixed
     */
    public function __call($method,$param=[]){
        if (isset($param[0])&&$param[0] instanceof SetMethod){
            if ($param[0] instanceof VirtualCallback){
                $this->_virtual[$method]=$param[0];
                return $this;
            }
            $this->_set[$method]=$param[0];
            return $this;
        }
        if (!isset($this->_set[$method])){
            if (isset($this->_virtual[$method])){
                throw new Exception(strtr("Unimplemented method: :method", array(":method"=>$method)));
            }else{
                throw new Exception(strtr("Undefined method: :method", array(":method"=>$method)));
            }
        }
        $call=$this->_set[$method];
        if($call instanceof Singleton){
            if (isset($param[0])&&$param[0] instanceof SingletonCache) {
                $obj=$param[0]->replace(isset($this->_cache[$method])?$this->_cache[$method]:null);
                if(is_null($obj)){
                    unset($this->_cache[$method]);
                }else{
                    $this->_cache[$method]=$obj;
                }
                return $this;
            }
            if (!array_key_exists($method, $this->_cache)){
                $this->_cache[$method]=call_user_func_array($call, $param);
            }
            $obj=$this->_cache[$method];
			unset($call);
        }elseif($call instanceof Share){
            if (isset($param[0])&&$param[0] instanceof ShareCache) {
                $handle=strval(call_user_func_array(array($call,'handle'), $param[0]->handleArgs()));
                $obj=$param[0]->replace(isset($this->_cache[$method])?$this->_cache[$method]:null);
                if(is_null($obj)){
                    unset($this->_cache_share[$method][$handle]);
                }else{
                    $this->_cache_share[$method][$handle]=$obj;
                }
                return $this;
            }
            $handle=strval(call_user_func_array(array($call,'handle'), $param));
            if (!isset($this->_cache_share[$method])||!array_key_exists($handle, $this->_cache_share[$method])){
                $this->_cache_share[$method][$handle]=call_user_func_array($call, $param);
            }
            $obj=$this->_cache_share[$method][$handle];
			unset($call);
        }elseif($call instanceof Method){
            $obj=call_user_func_array($call, $param);
            unset($call);
        }
        if (isset($call)) return $call;
        if(isset($this->_virtual[$method])){
            //check object
            $class=strval($this->_virtual[$method]);
            if (!empty($class)&&!$obj instanceof $class){
                throw new Exception(strtr("Your submit object[:object] not instanceof :class", 
                    array(":class"=>$class,':object'=>get_class($obj))
                ));
            }
            unset($this->_virtual[$method]);
        }
        return $obj;
    }
}
