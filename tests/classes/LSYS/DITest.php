<?php
namespace LSYS;
use PHPUnit\Framework\TestCase;
use LSYS\DI\MethodCallback;
use LSYS\DI\ShareCallback;
use LSYS\DI\SingletonCallback;
use LSYS\DI\VirtualCallback;
class dome_test_di extends \LSYS\DI {
    public static function get(){
        if(!self::has())self::set(new self());
        return parent::get();
    }
}
final class DITest extends TestCase
{
    public function testDi()
    {
        //1. 全局一个对象 默认DI
        //2. 局部一个对象 区域DI
        //3. 单个一个对象 特殊DI
        $di=DI::get();
        $di->test1(new VirtualCallback(\stdClass::class));
        $di->test1(new SingletonCallback(function(){
            return new \stdClass();
        }));
        $di->test2(new ShareCallback(function($id=null){
            return $id;
        },function($id=null){
            return new \stdClass();
        }));
        $di->test3(new MethodCallback(function($id=null){
            return new \stdClass();
        }));
        $this->assertTrue(isset($di->test1));
        $this->assertTrue(isset($di->test2));
        $this->assertTrue(isset($di->test3));
        $this->assertTrue($di->test1()===$di->test1());
        $this->assertTrue($di->test2('dddd')===$di->test2('dddd'));
        $this->assertTrue($di->test2('dddd')!==$di->test2('dddd1'));
        $this->assertTrue($di->test3('dddd')!==$di->test3('dddd'));
        $d1=$di->test1();
        $di->test1(new \LSYS\DI\ShareCache());
        $d2=$di->test1();
        $this->assertTrue($d1!==$d2);
        $d1=$di->test2('dddd');
        $di->test2(new \LSYS\DI\ShareCache());
        $d2=$di->test2('dddd');
        $this->assertTrue($d1!==$d2);
		unset($di->test1);
		$this->assertFalse(isset($di->test1));
    }
    public function testDiSET()
    {
        \LSYS\dome_test_di::set(function()use(&$test){
            $test=new class extends \LSYS\dome_test_di{};
            return $test;
        });
        $this->assertTrue($test===\LSYS\dome_test_di::get());
    }
}
