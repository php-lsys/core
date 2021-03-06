<?php
use LSYS\DI;
include __DIR__."/Bootstarp.php";


//取对象:先检查以当前类名为key的对象管理器是否存在,不存在取公用的对象管理器
//公共的对象管理器在编写类时候,会注册获取该类对象的方法.当用户编写代码时候没有主动注册时,该方法会被调用
//设置获取对象:调用管理的SET静态方法设置以当前类名为KEY的对象管理器.所以在上面取对象时候就不会再调用公共对象管理器

//可解决以下３个问题:
//1. 全局一个DI依赖
//2. 局部一个DI依赖
//3. 特殊一个DI依赖
//########### 解决类依赖问题[示例]　#################
//业务代码
class dome_a{};
class dome_b{};
//dome_c　依赖　dome_a　dome_b　两个类的实例
class dome_c{
    public function __construct(dome_a $dome_a,dome_b $dome_b){
        //你的具体业务
    }
}
//1. 定义外部调用接口 [必须]
/**
 * @method domeC　domeC() 获取dome_c的全局单例
 */
class dome_di extends DI{
    /**
     * @return static
     */
    public static function get(){
        $di=parent::get();
        //以下可二选一进行注册:
        //注册默认处理,当外部无注册时候使用
        !isset($di->domeC)&&$di->domeC(new \LSYS\DI\SingletonCallback(function (){
            return new dome_c(new dome_a(),new dome_b());
        }));
        //注册虚拟方法
       // $di->domeC(new \LSYS\DI\VirtualCallback(dome_c::class));
        return $di;
    }
}

// 2. 重置你的实现[可选]
dome_di::set(function (){
    return (new dome_di)->domeC(new \LSYS\DI\SingletonCallback(function (){
        return new dome_c(new dome_a(),new dome_b());
    }));
});


//3. 调用
$dome_c=dome_di::get()->domeC();
var_dump($dome_c);
