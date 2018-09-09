<?php
use LSYS\DI;
include __DIR__."/Bootstarp.php";
//########### di　简易使用　#################
//------------注册方法--------------------
//注册单例
DI::get()->test1(new LSYS\DI\SingletonCallback(function(){
    return new stdClass();//你的单例对象
}));
//注册共享对象[相同参数对象相同]
DI::get()->test2(new \LSYS\DI\ShareCallback(function($your_param){
    return $your_param;//返回唯一字符串
},function($your_param){
    return new stdClass();//你的共享对象
}));
//注册对象工厂
DI::get()->test3(new \LSYS\DI\MethodCallback(function($your_param){
    return new stdClass();//你的生成对象
}));

$di=DI::get();
//------------判断是否存在某方法-------------------
var_dump(isset($di->test1));
//------------使用注册方法------------------------
//取得单例
$di->test1();
//取得共享对象,
$di->test2('your params');
//对象工厂生成对象
$di->test3('your params');
//------------清理已存在的共享或单例对象------------
unset($di->test1);
//$di->test1();//再次调用重新生成单例
unset($di->test2);
//$di->test2('your params');//再次调用重新共享对象
unset($di->test3);//工厂生成方法将无任何操作


